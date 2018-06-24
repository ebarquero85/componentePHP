<?php

use App\AccessHandler as Access;
use PHPUnit\Framework\TestCase;

class AccessHandlerTest extends TestCase
{

    public function test_grand_access(){

        $this->assertTrue(Access::check('admin'));

    }

}