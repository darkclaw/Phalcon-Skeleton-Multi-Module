<?php

$loader = new \Phalcon\Loader();

/*
 * We're a registering a set of directories taken from the configuration file
 */

$loader->registerDirs(
    array(
        $config->application->pluginsDir,
        $config->application->libraryDir,
        $config->application->cacheDir,
        $config->application->migrationsDir,
    )
);

$loader->registerNamespaces([
    'Library' => APP_PATH.'/app/Library',
]);

$loader->register();
