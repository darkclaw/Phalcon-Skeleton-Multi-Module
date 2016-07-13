<?php
/**
 * Created by PhpStorm.
 * User: ilopez
 * Date: 6/14/16
 * Time: 17:42.
 */

return[
    'database' => [
        'adapter' => 'Mysql',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'local123456789',
        'dbname' => 'phalconSecurity',
        'charset' => 'utf8',
    ],
    'application' => [
        'migrationsDir' => APP_PATH.'/app/migrations/',
        'pluginsDir' => APP_PATH.'/app/plugins/',
        'libraryDir' => APP_PATH.'/app/library/',
        'cacheDir' => APP_PATH.'/app/cache/',
        'baseUri' => '/',
    ]
];
