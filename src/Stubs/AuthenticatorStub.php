<?php

namespace App\Stubs;

use App\AuthenticatorInterface;
use App\User;

class AuthenticatorStub implements AuthenticatorInterface
{

    public function check()
    {
        return true;
    }

    public function user()
    {
        return new User([
            'role' => 'admin'
        ]);
    }

}