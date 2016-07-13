<?php

namespace Apps\Frontend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;


class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(array(
            'Apps\Frontend\Controllers' => __DIR__ . '/controllers/',
        ));

        $loader->register();

    }

    public function registerServices(DiInterface $di)
    {
        /**
         * Read configuration
         */
        $config = include __DIR__ . '/config/config.php';

        $di['dispatcher'] = function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Apps\Frontend\Controllers");

            return $dispatcher;
        };

        /**
         * Setting up the view component
         */
        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');

            $view->registerEngines(array(
                '.volt' => function ($view, $di) {

                    $volt = new VoltEngine($view, $di);

                    $volt->setOptions(array(
                        'compiledPath' => __DIR__ . '/cache/',
                        'compiledSeparator' => '_',
                    ));

                    return $volt;
                },
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
            ));

            return $view;
        });

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di->set('db', function () use ($config) {
            $dbConfig = $config->database->toArray();
            $adapter = $dbConfig['adapter'];

            unset($dbConfig['adapter']);

            $class = 'Phalcon\Db\Adapter\Pdo\\'. $adapter;

            return new $class($dbConfig);
        });

    }
}
