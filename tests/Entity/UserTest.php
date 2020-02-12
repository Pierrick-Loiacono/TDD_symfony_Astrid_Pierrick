<?php
namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;


class UserTest extends TestCase {

    protected $user;

    public function setUp() :void
    {
        $this->user = new User();
    }

    public function testNewUser(){
        $this->assertInstanceOf(User::class, new User());
    }

    public function testUserNom(){
        $this->user->setNom("Patrick");
        $this->assertEquals("Patrick", $this->user->getNom());
    }

    public function testUserPrenom(){
        $this->user->setPrenom("Paulien");
        $this->assertEquals("Paulien", $this->user->getPrenom());
    }


}
