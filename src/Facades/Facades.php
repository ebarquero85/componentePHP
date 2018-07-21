<?php

namespace App\Facades;

use App\Container;
use Exception;

abstract class Facades
{

    protected static $container;

    public static function setContainer(Container $container)
    {
        static::$container = $container;
    }

    public static function getContainer()
    {
        return static::$container;
    }

    public static function getAccessor()
    {
        throw new Exception('Please define getAccessor method in your facade');
    }

    public static function __callStatic($method, $arguments)
    {

        $object = static::$container::getInstance()->make(static::getAccessor());

        return call_user_func_array([$object, $method], $arguments);

    }

}