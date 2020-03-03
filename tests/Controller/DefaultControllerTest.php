<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultControllerTest extends WebTestCase
{

    public function testHomepage()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertSelectorExists('a[href="/login"]');
        $this->assertSelectorExists('a[href="/register"]');
        $this->assertSelectorExists('form[action="/recherche"]');
    }

    public function testHomepageUser()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW'   => 'pa$$word',
        ]);

        $client->request('GET', '/');
        $this->assertSelectorNotExists('a[href="/login"]');
        $this->assertSelectorNotExists('a[href="/register"]');
        $this->assertSelectorExists('a[href="/logout"]');

        $client->clickLink('Déconnexion');
        $this->assertResponseRedirects('http://localhost/');
    }


}
