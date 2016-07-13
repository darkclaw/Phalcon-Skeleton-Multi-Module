<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'local123456789',
        'name' => 'phalconSecurity',
        'charset' => 'utf8',
    ),
    'application' => array(
        'controllersDir' => APP_PATH.'/apps/frontend/controllers/',
        'viewsDir' => APP_PATH.'/apps/frontend/views/',
        'cacheDir' => APP_PATH.'/apps/frontend/cache/',
        'modelsDir' => APP_PATH.'/apps/frontend/models/',
        'migrationsDir' => APP_PATH.'/apps/frontend/migrations/',
        'pluginsDir' => APP_PATH.'/apps/frontend/plugins/',
        'formsDir' => APP_PATH.'/apps/frontend/forms/',
    )
));
