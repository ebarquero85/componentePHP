<?php

use App\Container;

class ContainerTest extends \PHPUnit\Framework\TestCase
{


    public function test_bind_from_closure(){


        $container = New Container();

        $container->bind('key', function(){
           return 'Object';
        });

        $this->assertSame('Object', $container->make('key'));


    }

    public function test_bind_instance()
    {

        $container = new Container();

        $std = new stdClass();

        $container->instance('std', $std);

        $this->assertSame($std, $container->make('std'));


    }

    public function test_bind_from_class_name()
    {

        $container = new Container();

        $container->bind('key','Foo');

        $this->assertInstanceOf('Foo',$container->make('key'));

    }


}


class Foo{

}




