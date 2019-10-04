<?php
require 'config.php';
define("__root__", __DIR__);
if (env == 'development') {
    define('__base__', '/yldzlab');
} else {
    define('__base__', '');
}


require __root__ . '/vendor/autoload.php';
require 'core/setup.php';


// Lang::calture('tr');

Router::get('', 'HomeController', 'index');
