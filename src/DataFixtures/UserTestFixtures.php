<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserTestFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setNom('Pierrick');
        $user->setPrenom('Pierrick');
        $user->setEmail('pierrick@test.fr');
        $user->setRoles(['ROLE_USER']);
        $pass = $this->encoder->encodePassword($user, 'pa$$word');
        $user->setPassword($pass);
        $user->setUsername('username');

        $manager->persist($user);
        $manager->flush();
    }
}
