<?php


namespace Core\Cookie;


use Core\App;

class Cookie
{
    public static function setCookie($name, $value, $time = 0 )
    {
        if(!$time) {
            $time = time() + 3600 * 24 * 7;
        }
        $name = base64_encode($name);

        setcookie($name, $value, $time, '/', App::$app->getProperty('site_url'));
    }

    public static function getCookie($key)
    {
        $name = base64_encode($key);
        return $_COOKIE[$name] ?: null;
    }

    public static function removeCookie($key)
    {
        $name = base64_encode($key);
        setcookie($name, '', time() - 100);
    }
}