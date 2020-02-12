<?php
namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;


class UserTest extends TestCase {

    public function testNewUser(){
        $this->assertInstanceOf(User::class, new User());
    }


}
