<?php

namespace App\Tests\Entity;

use App\Entity\Lieu;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Constraints\DateTime;


class TrajetControllerTest extends WebTestCase
{

    public function testForbiddenToUser()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/trajet/new');

        $this->assertNotEquals(200, $client->getResponse()->getStatusCode());

        $this->assertResponseRedirects('/login');
    }

    public function testAllowedToUser()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW' => 'pa$$word',
        ]);
        $crawler = $client->request('GET', '/trajet/new');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testListeTrajet()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW' => 'pa$$word',
        ]);
        $crawler = $client->request('GET', '/trajet/liste');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testCreateTrajet()
    {
        $username = 'username';
        $password = 'pa$$word';
        $client = static::createClient([], [
            'PHP_AUTH_USER' => $username,
            'PHP_AUTH_PW' => $password,
        ]);

        // Récupération de l'utilisateur connecté dans la base
        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $user = $entityManager
            ->getRepository(User::class)
            ->findOneBy(['username' => $username]);
        $lieuDepart = $entityManager
            ->getRepository(Lieu::class)
            ->findOneBy(['nom' => 'France']);
        $lieuArrive = $entityManager
            ->getRepository(Lieu::class)
            ->findOneBy(['nom' => 'Portugal']);

        $this->assertEquals('username', $user->getUsername());
        $crawler = $client->request('GET', '/trajet/new');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $buttonCrawlerNode = $crawler->selectButton('Save');

        $form = $buttonCrawlerNode->form([
            'trajet[lieu_depart]' => $lieuDepart->getId(),
            'trajet[lieu_arrive]' => $lieuArrive->getId(),
            'trajet[places]' => 4,
            'trajet[conducteur]' => $user->getId(),
        ]);
        $this->assertEquals($user->getId(), $form['trajet[conducteur]']->getValue()); // On verifie qu'on a bien le conducteur passé dans le formulaire
        $crawler = $client->submit($form);
        // Récupération de la redirection après création du trajet vers la liste des trajet
        $crawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode()); // On verifie qu'on a bien un code 200
        $this->assertContains('/trajet/liste', $crawler->getUri()); // On verifie qu'on a bien un code 200


        $entityManager->close();
        $entityManager = null;


    }


}
