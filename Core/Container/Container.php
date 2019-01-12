<?php


namespace Core\Container;


class Container
{
    protected $container = [];

    protected $shared = [];

    public function set($key, $class)
    {
        $this->container[$key] = function() use($class) {
            return new $class;
        };
    }

    public function shared($key, $class) {
        $this->shared[$key] = new $class;
    }

    public function get($key)
    {
        if(array_key_exists($key, $this->shared)) {
            return $this->shared[$key];
        }
        return $this->container[$key] ?: null;
    }
}