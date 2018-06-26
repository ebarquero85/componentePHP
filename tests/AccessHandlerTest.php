<?php

use App\AccessHandler as Access;
use App\Authenticator;

use App\Container;
use App\User;
use PHPUnit\Framework\TestCase;

class AccessHandlerTest extends TestCase
{

    public function tearDown()/* The :void return type declaration that should be here would cause a BC issue */
    {
        Mockery::close();
    }

    public function test_grand_access(){

        $user = Mockery::mock(User::class);
        $user->role = 'admin';

        $auth = Mockery::mock(Authenticator::class);

        $auth->shouldReceive('check')
            ->once()
            ->andReturn(true);

        $auth->shouldReceive('user')
            ->once()
            ->andReturn($user);

        $access = new Access($auth);

        $this->assertTrue(
            $access->check('admin')
        );

    }

    public function test_container()
    {

        $container = New Container();

        $this->assertTrue(
            Container::getInstance()->access()->check('student')
        );

    }

}