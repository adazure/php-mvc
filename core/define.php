<?php

define("__REFERER__", isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/');
define("__ISROOT__", __REFERER__ != '/' ? parse_url(__REFERER__, PHP_URL_HOST) == $_SERVER['HTTP_HOST'] : false);
