<?php

namespace App;


use Closure;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;

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

    public function make($name, array $arguments = [])
    {

        if (isset($this->shared[$name])) {
            return $this->shared[$name];
        }

        if(isset($this->binding[$name])){
            $resolver = $this->binding[$name]['resolver'];
        }
        else{
            $resolver = $name;
        }

        if ($resolver instanceof Closure) {
            $object = $resolver($this);
        } else {
            $object = $this->build($resolver, $arguments);
        }

        return $object;


    }

    public function build($class, array $arguments = [])
    {

        try{
            $reflection = new ReflectionClass($class);
        }catch (ReflectionException $e){
            throw new ContainerException('No existe la clase');
        }

        if (!$reflection->isInstantiable()) {
            throw new InvalidArgumentException("La clase {$class} no es instanciable");
        }

        $constructor = $reflection->getConstructor(); // Devuelve un ReflectionMethod

        if (is_null($constructor)) {
            return new $class;
        }

        $constructorParameters = $constructor->getParameters(); // Devuelve un arreglo de [ReflectionParameter]

        $dependencies = [];

        foreach ($constructorParameters as $constructorParameter) {

            $parameterName = $constructorParameter->getName();

            if(isset($arguments[$parameterName])){
                $dependencies[] = $parameterName;
                continue;
            }

            try {
                $parameterClass = $constructorParameter->getClass();
            } catch (ReflectionException $e) {
                throw new ContainerException("La clase [$parameterName]: " . $e->getMessage(), null, $e);
            }

            if(!is_null($parameterClass)){

                $parameterClassName = $parameterClass->getName();
                $dependencies[] = $this->build($parameterClassName);

            }else{
                throw new ContainerException("Please provide the value of the parameter [$parameterName]");
            }


        }

        return $reflection->newInstanceArgs($dependencies);

    }

}