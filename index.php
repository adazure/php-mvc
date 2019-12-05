<?php
require 'config.php';
define("__root__", __DIR__);
if (env == 'development') {
    define('__base__', '');
} else {
    define('__base__', '');
}


require __root__ . '/vendor/autoload.php';
require 'core/setup.php';

