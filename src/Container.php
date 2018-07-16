<?php

namespace App;


use Closure;

class Container
{

    protected $binding = [];
    protected $shared = [];


    public function bind($name, $resolver)
    {

        $this->binding[$name] = [
            'resolver' => $resolver
        ];


    }

    public function instance($name, $object)
    {

        $this->shared[$name] = $object;

    }

    public function make($name)
    {
        if (isset($this->shared[$name])) {
            return $this->shared[$name];
        }


        $resolver = $this->binding[$name]['resolver'];

        if ($resolver instanceof Closure) {
            $object = $resolver($this);
        } else {
            $object = new $resolver;
        }

        return $object;


    }


}