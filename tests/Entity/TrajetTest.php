<?php
namespace App\Tests\Entity;

use App\Entity\Trajet;
use App\Entity\Lieu;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\DateTime;


class TrajetTest extends TestCase {

    protected $trajet;

    public function setUp() :void
    {
        $this->trajet = new Trajet();
    }

    public function testTrajet(){
        $this->assertInstanceOf(Trajet::class, $this->trajet);
        $this->assertNull($this->trajet->getId());
    }

    public function testTrajetLieuDepart(){
        $lieu = new Lieu();
        $lieu->setNom("Paris");
        $this->trajet->setLieuDepart($lieu);
        $this->assertEquals($lieu, $this->trajet->getLieuDepart());

    }

    public function testTrajetLieuArrive(){
        $lieu = new Lieu();
        $lieu->setNom("Paris");
        $this->trajet->setLieuArrive($lieu);
        $this->assertEquals($lieu, $this->trajet->getLieuArrive());
    }

    public function testTrajetDateHeureDepart() {
        $date = new \DateTime();
        $this->trajet->setDate($date);
        $this->assertEquals($date, $this->trajet->getDate());

    }

    public function testTrajetConducteur(){
        $user = new User();
        $this->trajet->setConducteur($user);
        $user->addTrajet($this->trajet);
        $this->assertEquals($user, $this->trajet->getConducteur());
        $this->assertContains($this->trajet, $user->getTrajets());

    }

    public function testTrajetPassager(){
        $user = new User();
        $this->trajet->addPassager($user);
        $user->addTrajet($this->trajet);
        $this->assertContains($user, $this->trajet->getPassagers());
        $this->assertContains($this->trajet, $user->getTrajets());
    }

}
