<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {

    /*
     * Read the configuration
     */
    $config = include APP_PATH.'/app/config/config.php';

    /**
     * Read auto-loader.
     */
    include APP_PATH.'/app/config/loader.php';

    /**
     * Read services.
     */
    include APP_PATH.'/app/config/services.php';

    /**
     * Read routes
     */
    include APP_PATH.'/app/config/routes.php';


    /*
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    /**
     * Register the installed module
     */
    $application->registerModules(
        array(
            'frontend' => array(
                'className' => 'Apps\Frontend\Module',
                'path'      => '../apps/frontend/Module.php',
            )
        )
    );

    echo $application->handle()->getContent();
} catch (\Exception $e) {
    echo $e->getMessage().'<br>';
    echo '<pre>'.$e->getTraceAsString().'</pre>';
}
