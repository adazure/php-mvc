<?php
class Response
{
    public static function redirect($url)
    {
        header("Location: " . (!empty($url) ? $url : '/'), true);
        exit();
    }
}
