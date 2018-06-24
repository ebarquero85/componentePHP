<?php

use App\AccessHandler as Access;
use App\AccessHandler;
use App\Authenticator as Auth;
use App\Authenticator;
use App\SessionManager as Session;
use App\SessionArrayDriver;

use App\Stubs\AuthenticatorStub;
use PHPUnit\Framework\TestCase;

class AccessHandlerTest extends TestCase
{

    public function test_grand_access(){

        $auth = new AuthenticatorStub();
        $access = new Access($auth);

        $this->assertTrue(
            $access->check('admin')
        );

    }

}