<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

defined('APP_ENVIRONMENT') || define('APP_ENVIRONMENT', (getenv('APP_ENVIRONMENT') ? getenv('APP_ENVIRONMENT') : 'production'));

/*
 * Read the configuration
 */
$envConfig = include APP_PATH .'/app/config/environment/'. APP_ENVIRONMENT .'.php';



$configApp = new \Phalcon\Config($envConfig);

return $configApp;
