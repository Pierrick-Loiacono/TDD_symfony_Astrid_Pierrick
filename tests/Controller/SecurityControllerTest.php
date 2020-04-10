<?php
namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class SecurityControllerTest extends WebTestCase {

    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testLogin() {
        $this->client->request('GET', '/login');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testLogout() {
        $this->client->followRedirects();
        $this->client->request('GET', '/logout');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testLoginForm(){
        //Récupération du contenu de la page
        $crawler = $this->client->request('GET', '/login');

        //Récupération du formulaire grâce au texte que contient le bouton associé au formulaire
        $form = $crawler->selectButton('Sign in')->form();

        // On set les valezurs du formualire
        $form->setValues([
            'username' => 'username',
            'password' => 'pa$$word',
        ]);
        // Soumission du formulaire
        $crawler = $this->client->submit($form);
        // On vérifie qu'on a une redirection
        $this->assertTrue($this->client->getResponse()->isRedirect());
        // On récupére la redirection ainsi que le contenu de la page sur laquelle on est redirigé
        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode()); // On verifie qu'on a bien un code 200
        $this->assertContains('/trajet/liste', $crawler->getUri()); // On verifie qu'on a bien un code 200

    }

}
