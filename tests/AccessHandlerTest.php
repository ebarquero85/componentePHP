<?php

use App\AccessHandler as Access;
use App\Authenticator as Auth;
use App\SessionManager as Session;
use App\SessionFileDriver as Driver;
use PHPUnit\Framework\TestCase;

class AccessHandlerTest extends TestCase
{

    public function test_grand_access(){

        $driver = New Driver;
        $session = new Session($driver);
        $auth = new Auth($session);
        $access = new Access($auth);

        $this->assertTrue(
            $access->check('admin')
        );

    }

}