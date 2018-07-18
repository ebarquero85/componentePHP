<?php

use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{

    public function test_singleton_instance()
    {

        $this->assertInstanceOf(
            GreeterDummy::class,
            GreeterDummy::getInstance()
        );

    }

    public function test_singleton_create_only_one_instance()
    {

        $this->assertSame(
            GreeterDummy::getInstance(),
            GreeterDummy::getInstance()
        );

    }

    public function test_welcome_known_user()
    {

        $greeter = GreeterDummy::getInstance('Edgard');

        $this->assertSame('Bienvenido Invitado', $greeter->welcome());

    }


}

class GreeterDummy
{

    private static $instance;
    private $name = 'Invitado';

    private function __construct($name = null)
    {
        if ($name != null) {
            $this->name = $name;
        }

    }

    public static function getInstance($name = null)
    {
        if (is_null(static::$instance)) {
            static::$instance = new GreeterDummy($name);
        }

        return static::$instance;

    }

    public function welcome()
    {
        return 'Bienvenido ' . $this->name;

    }


}