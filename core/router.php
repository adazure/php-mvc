<?php

class Router
{

    private static $ROUTES = [];
    private static $ROUTES_STATIC_VIEWS = [];
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

    public static function notfound($controller, $action)
    {
        if (!self::$LOCK) {
            http_response_code(302);
            self::runController($controller, $action, []);
        }
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

/****************************************************************** */

    public static function absolute($datas = [], $controller, $action)
    {
        if (!self::$LOCK) {

            foreach ($datas as $key => $data) {
                $body = [
                    'url' => '',
                    'view' => '',
                    'data' => [],
                    'params' => [],
                ];
                if (is_array($data)) {
                    $body['url'] = !empty($data['url']) ? $data['url'] : '';
                    $body['view'] = !empty($data['view']) ? $data['view'] : '';
                    $body['data'] = !empty($data['data']) ? $data['data'] : [];
                    $key = $body['url'];
                } else {
                    $body['url'] = $key;
                    $body['view'] = $data;
                }

                self::isMatchUrl($body['url'], function ($params) use ($body, $controller, $action) {

                    $body['params'] = $params;
                    self::$LOCK = true;
                    self::runController($controller, $action, (object) $body);
                });
            }
        }

    }

/**************************************************************** */

    private static function runController($controller, $action, $arr)
    {
        self::$LOCK = true;
        $controllerFile = self::$CONTROLLER_PATH . $controller . '.php';
        require_once $controllerFile;
        call_user_func([new $controller, $action], $arr);
    }
/**************************************************************** */

    private static function isMatchUrl($url, $success = null)
    {
        $map = str_replace('/', '\/', $url);
        $uri = $_SERVER["REQUEST_URI"];
        if (strrpos($uri, '?') > 0) {
            $uri = substr($uri, 0, strrpos($uri, '?'));
        }
        $base = str_replace(__base__, '', $uri);
        if (preg_match('/^' . $map . '[\/]*$/', $base, $matches)) {
            if (is_callable($success)) {
                call_user_func_array($success, $matches);
            }
        }
    }

/**************************************************************** */

    private static function parse($url, $controller, $action)
    {
        if (!self::$LOCK) {
            self::isMatchUrl($url, function (...$params) use ($controller, $action) {
                self::runController($controller, $action, $params);
            });
        }
    }

    /***************************************************************** */

}
