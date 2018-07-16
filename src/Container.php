<?php

namespace App;


use Closure;
use InvalidArgumentException;
use ReflectionClass;

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
            $object = $this->build($resolver);
            //$object = new $resolver;
        }

        return $object;


    }

    public function build($name)
    {

        $reflection = new ReflectionClass($name);

        if(!$reflection->isInstantiable()){
            throw new InvalidArgumentException("La clase {$name} no es instanciable");
        }


        $constructor = $reflection->getConstructor(); // Devuelve un ReflectionMethod

        if(is_null($constructor)){
            return new $name;
        }

        $constructorParameters = $constructor->getParameters(); // Devuelve un arreglo de [ReflectionParameter]

        $arguments = [];

        foreach ($constructorParameters as $constructorParameter) {

            $parameterClassName = $constructorParameter->getClass()->getName();

            $arguments[] = $this->build( $parameterClassName);

        }


        return $reflection->newInstanceArgs($arguments);


    }


}