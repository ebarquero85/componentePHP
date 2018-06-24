<?php

namespace App;


class SessionManager
{

    protected static $loaded = false;
    protected static $data = array();

    public static function get($key)
    {

        static::load();

        return isset(static::$data[$key])
            ? static::$data[$key]
            : null;

    }

    private static function load()
    {

        if(static::$loaded) return true;

        static::$data = SessionFileDriver::load();

        static::$loaded = true;

    }
}