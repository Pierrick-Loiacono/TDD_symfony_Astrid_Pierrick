<?php

namespace App\DataFixtures;

use App\Entity\Lieu;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LieuTestFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $lieuDepart = new Lieu();
        $lieuDepart->setNom('France');
        $lieuDepart->setLongitude(55.60);
        $lieuDepart->setLatitude(55.60);

        $lieuArrive = new Lieu();
        $lieuArrive->setNom('Portugal');
        $lieuArrive->setLongitude(75.60);
        $lieuArrive->setLatitude(95.60);

        $manager->persist($lieuDepart);
        $manager->persist($lieuArrive);
        $manager->flush();
    }
}
