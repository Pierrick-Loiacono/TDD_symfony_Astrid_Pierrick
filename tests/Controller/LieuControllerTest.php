<?php

namespace App\Tests\Entity;

use App\Entity\Lieu;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Constraints\DateTime;


class LieuControllerTest extends WebTestCase
{

    public function testForbiddenToUser()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/lieu/new');

        $this->assertNotEquals(200, $client->getResponse()->getStatusCode());

        $this->assertResponseRedirects('/login');
    }

    public function testAllowedToUser()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW' => 'pa$$word',
        ]);
        $crawler = $client->request('GET', '/lieu/new');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testListeLieu()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW' => 'pa$$word',
        ]);
        $crawler = $client->request('GET', '/lieu/liste');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testCreateLieu()
    {
        $username = 'username';
        $password = 'pa$$word';
        $client = static::createClient([], [
            'PHP_AUTH_USER' => $username,
            'PHP_AUTH_PW' => $password,
        ]);
        $crawler = $client->request('GET', '/lieu/new');


        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $buttonCrawlerNode = $crawler->selectButton('Save');

        $form = $buttonCrawlerNode->form([
            'lieu[nom]' => 'TestLieu',
            'lieu[longitude]' => 10.2,
            'lieu[latitude]' => 55.5,
        ]);
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect()); // Check de la redirection
        // Récupération de la redirection après création du trajet vers la liste des trajet
        $crawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode()); // On verifie qu'on a bien un code 200
        $this->assertContains('/lieu/liste', $crawler->getUri()); // On verifie qu'on a bien un code 200

        // On vérifie qu'on a bien le nom du lieu passé dans le formulaire dans la page de la liste des lieux
        $this->assertTrue($crawler->filter('html:contains(' . $form['lieu[nom]']->getValue() . ')')->count() > 0);

//        $crawler = $client->request('GET', '/trajet/new');
//        $this->assertInputValueSame($crawler->selectButton('Save')->form()['trajet[lieu_depart]']->getValue(), 1);

    }


}
