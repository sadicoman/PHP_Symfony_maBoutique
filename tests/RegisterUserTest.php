<?php

// pour lancer le test : php bin/phpunit

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterUserTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/inscription');

        $client->submitForm('Valider', [
            'register_user[email]'  => 'Julie@test.com',
            'register_user[plainPassword][first]'  => '123456',
            'register_user[plainPassword][second]' => '123456',
            'register_user[firstName]' => 'Julie',
            'register_user[lastName]' => 'Doe'

        ]);

        $this->assertResponseRedirects('/connexion');
        $client->followRedirect();

        $this->assertSelectorExists('div:contains("Votre compte a bien été créé, veuillez vous connecter !")');
    }
}
