<?php
define("__root__", __DIR__);

require 'vendor/autoload.php';
require 'core/setup.php';

/**
 * $capsule = new Capsule();
 *
 * $capsule->addConnection([
 *   'driver' => 'mysql',
 *   'host' => 'localhost',
 *   'database' => '********',
 *   'username' => 'root',
 *   'password' => '******',
 *   'charset' => 'utf8',
 *   'collation' => 'utf8_unicode_ci',
 *   'prefix' => '',
 *  ]);
 */
//

$router = new Router([
    [
        'url' => '',
        'controller' => 'HomeController',
        'action' => 'index',
    ],
    [
        'url' => '/product',
        'controller' => 'HomeController',
        'action' => 'product',
    ],
]);
