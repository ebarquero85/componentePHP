<?php

use App\Container;
use App\ContainerException;

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


        $container->bind('key','stdClass');

        $this->assertInstanceOf('stdClass',$container->make('key'));

    }

    public function test_bind_with_automatic_resolution()
    {

        $container = new Container();

        $container->bind('foo','Foo');

        $this->assertInstanceOf('Foo',$container->make('foo'));

    }

    /**
     * @expectedException App\ContainerException
     *
     */
    public function test_bind_with_no_dependecy_class_exist()
    {

//        $this->expectException(
//            ContainerException::class
//        );

        $container = new Container();

        $container->bind('qux','Qux');

        $container->make('qux');

    }


    public function test_container_make_with_arguments()
    {

        $container = new Container();

        $this->assertInstanceOf(
            MailDummy::class,
            $container->make('MailDummy', ['url' => 'www.barquero.com', 'key' => 'secret'])
        );
        
    }

    public function test_singleton_instance()
    {

        $container = new Container();

        $container->singleton('foo','Foo');

        $this->assertSame(
            $container->make('foo'),
            $container->make('foo')
        );

    }

}


class MailDummy{

    private $url;
    private $key;

    public function __construct($url, $key)
    {
        $this->url = $url;
        $this->key = $key;
    }

}


class Foo{

    public function __construct(Bar $bar)
    {

    }

}

class Bar{

    public function __construct(FooBar $foobar)
    {

    }


}

class FooBar{

}


class Qux{

    public function __construct(Bazz $bazz)
    {

    }

}




