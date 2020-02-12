<?php
namespace App\Tests\Entity;

use App\Entity\Lieu;
use PHPUnit\Framework\TestCase;


class LieuTest extends TestCase {

    protected $lieu;

    public function setUp() :void
    {
        $this->lieu = new Lieu();
    }

    public function testLieu(){
        $this->assertInstanceOf(Lieu::class, $this->lieu);
        $this->assertNull($this->lieu->getId());
    }

    public function testLieuNom(){
        $this->lieu->setNom("France");
        $this->assertEquals("France", $this->lieu->getNom());
    }

    public function tesLieuLongitude(){
        $this->lieu->setLongitude(55.60);
        $this->assertEquals(55.60, $this->lieu->getLongitude());
    }

    public function testLieuLatitude(){
        $this->lieu->setLatitude(55.60);
        $this->assertEquals(55.60, $this->lieu->getLatitude());
    }

}
