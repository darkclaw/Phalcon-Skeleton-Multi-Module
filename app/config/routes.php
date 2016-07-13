<?php
/**
 * Created by PhpStorm.
 * User: ilopez
 * Date: 5/26/16
 * Time: 18:50.
 */

// Specify routes for modules
// More information how to set the router up https://docs.phalconphp.com/es/latest/reference/routing.html
$di->set('router', function () {

    $router =  new \Phalcon\Mvc\Router();
    $router->setDefaultModule("frontend");

    return $router;
});

