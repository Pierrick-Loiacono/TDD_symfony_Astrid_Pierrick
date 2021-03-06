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

    public function testUserName(){
        $this->user->setUserName("pp");
        $this->assertEquals("pp", $this->user->getUsername());
    }

    public function testUserPassword(){
        $this->user->setPassword("xyz");
        $this->assertEquals("xyz", $this->user->getPassword());
    }

    public function testEmailUser(){
        $this->user->setEmail("paupau@gmail.com");
        $this->assertEquals("paupau@gmail.com", $this->user->getEmail());
    }


}
