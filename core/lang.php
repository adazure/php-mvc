<?php

class Lang
{
    private static $CURRENT_DATA = [];

    public static function calture($name)
    {
        $file = __root__ . '/langs/' . $name . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }

    public static function set($data)
    {
        self::$CURRENT_DATA = $data;
    }

    public static function list(){
        return self::$CURRENT_DATA;
    }

    public static function get($name)
    {
        return !empty(self::$CURRENT_DATA[$name]) ? self::$CURRENT_DATA[$name] : "";
    }

}
