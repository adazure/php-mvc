<?php

class Router
{

    private $CONTROLLER_PATH = __root__ . '/controllers/';

    private function runAction($route, $arr)
    {
        $controller = $this->CONTROLLER_PATH . $route['controller'] . '.php';
        require_once $controller;
        call_user_func_array([new $route['controller'], $route['action']], $arr);
    }

    private function parse($route)
    {
        $map = str_replace('/', '\/', $route['url']);
        $map = preg_replace('/\{[a-zA-Z0-9_-]+\}/', '(\w+?)', $map);
        if (preg_match('/^' . $map . '[\/]*$/', $_SERVER["REQUEST_URI"], $matches)) {
            $this->runAction($route, array_splice($matches, 1));
            exit;
        }
    }

    public function __construct($routes)
    {
        foreach ($routes as $key => $value) {
            $this->parse($value);
        }
        
        header('Location: /', true, 301);
exit;
    }

}
