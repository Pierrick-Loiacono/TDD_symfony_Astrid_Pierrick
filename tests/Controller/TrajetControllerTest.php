<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


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

    // scénario test crétion de trajet
    // poster le formulaire de création de trajets -- Fait
    // aller sur /trajet/liste -- Fait
    // vérifier que le trajet exsite même date
    // vérifier que le conducteur est l'utilisateur courant

    // scénario de test création de lieu
    // aller sur création trajet
    // suivre le lien nouveau lieu
    // poster le formulaire de nouveau lieu
    // revenir sur le création de trajet
    // vérifier le lieu existe dans le input


}
