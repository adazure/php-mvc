<?php
if (!defined('extension')) {
    define("extension", ".twig");
}
require __root__.'/core/define.php';
require __root__.'/core/database.php';
require __root__.'/core/lang.php';
require __root__.'/core/controller.php';
require __root__.'/core/router.php';
require __root__.'/core/response.php';
require __root__.'/middleware/routing.php';
