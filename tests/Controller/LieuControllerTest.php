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

    public function testListeTrajet()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW' => 'pa$$word',
        ]);
        $crawler = $client->request('GET', '/lieu/liste');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

}
