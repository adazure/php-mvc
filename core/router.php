<?php

class Router
{

    private static $ROUTES = [];
    private static $CONTROLLER_PATH = __root__ . '/controllers/';
    private static $LOCK = false;

    public static function get($url, $controller, $action)
    {

        self::route($url, $controller, $action, 'GET');
    }

    public static function post($url, $controller, $action)
    {
        self::route($url, $controller, $action, 'POST');
    }

    public static function delete($url, $controller, $action)
    {
        self::route($url, $controller, $action, 'DELETE');
    }

    public static function put($url, $controller, $action)
    {
        self::route($url, $controller, $action, 'PUT');
    }

    public static function test()
    {
        return "Run function";
    }
/**************************************************************** */
    private static function route($url, $controller, $action, $method)
    {
        if ($method === $_SERVER["REQUEST_METHOD"]) {
            self::parse($url, $controller, $action);
        }
    }
/**************************************************************** */

    private static function runController($controller, $action, $arr)
    {
        self::$LOCK = true;
        $controllerFile = self::$CONTROLLER_PATH . $controller . '.php';
        require_once $controllerFile;
        call_user_func_array([new $controller, $action], $arr);
    }
/**************************************************************** */

    private static function parse($url, $contoller, $action)
    {
        if (!self::$LOCK) {
            $map = str_replace('/','\/', $url);
            $base = str_replace(__base__,'',$_SERVER["REQUEST_URI"]);
            $map = preg_replace('/\{[a-zA-Z0-9_-]+\}/', '(\w+?)', $map);
           
            if (preg_match('/^' . $map . '[\/]*$/', $base, $matches)) {
                self::runController($contoller, $action, []);
            }
        }
    }

}
