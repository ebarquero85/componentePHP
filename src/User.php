<?php

namespace App;


class User
{

    protected $attributes;

    public function __construct(array $attributes = array())
    {

        $this->attributes = $attributes;

    }

    public function __get($key)
    {
        return isset($this->attributes[$key])
            ? $this->attributes[$key]
            : null;
    }


}