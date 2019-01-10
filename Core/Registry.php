<?php

namespace Core;


class Registry
{
    use TSingletone;

    protected static $properties = [];

    public function setProperty($key, $value)
    {
        self::$properties[$key] = $value;
    }

    public function getProperty($key)
    {
        return self::$properties[$key] ? self::$properties[$key] : null;
    }

    public function getProperties()
    {
        return self::$properties;
    }
}