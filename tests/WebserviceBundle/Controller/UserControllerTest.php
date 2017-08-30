<?php

namespace Tests\WebserviceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    /*
    public function testListUser()
    {
        $client = static::createClient();

        $client->request('GET', 'http://localhost:8000/api/users');
        $r = $client->getResponse();
        //var_dump($r->getContent(), $r->getStatusCode());
        $this->assertSame(200, $r->getStatusCode());

    }

    public function testCreationUser()
    {
        $client = static::createClient();
        $client->request('PUT', 'http://localhost:8000/api/users/new', [
            'username' => "setni",
            'email' => "bonjour@bonjour.com",
            'password' => "azer",
            //'birthday' => "02/05/1988",
            //'firstname' => "dupont",
            //'mobile' => "0651193342",
            //'name' => "thomas",
            //'zip_code' => "95000",
            //'address' => "Rue de ta mere"
        ]);
        $r = $client->getResponse();
        $this->assertEquals('{"success":false,"message":"invalide request"}', $r->getContent());

        $client->request('PUT', 'http://localhost:8000/api/users/new', [
            'username' => "setni",
            'email' => "bonjour@bonjour.com",
            'password' => "azer",
            //'birthday' => "02/05/1988",
            //'firstname' => "dupont",
            //'mobile' => "0651193342",
            'name' => "thomas",
            //'zip_code' => "95000",
            //'address' => "Rue de ta mere"
        ]);
        $r = $client->getResponse();
        //var_dump($r->getContent());
        $this->assertSame(200, $r->getStatusCode());

    }

    public function testDeleteUser()
    {
        $client = static::createClient();
        $client->request('DELETE', 'http://localhost:8000/api/users/delete', [
            'apikey' => "590f9348323b7",
            'secret' => "a49e74ab3c4dca88c0eb5aeee052711f56b4ad5867c9fa6262cdf8cbf97ad73d8cc004bebf5a623e9725d0480a2642b4a28a3f1777613da836b1b83f52dfc091"
        ]);
        $r = $client->getResponse();
        $this->assertSame(200, $r->getStatusCode());
    }

    public function testLogin()
    {
        $client = static::createClient();
        $client->request('POST', 'http://localhost:8000/api/users/login', [
            'username' => "setni",
            'password' => "azer"
        ]);
        $r = $client->getResponse();
        var_dump($r->getContent());
        $this->assertSame(200, $r->getStatusCode());
    }
    */
    public function testViewProfil()
    {
        $client = static::createClient();
        $client->request('GET', 'http://localhost:8000/api/profil/view', [
            'apikey' => "59109a8ab3a9a",
            'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1"
        ]);
        $r = $client->getResponse();
        var_dump($r->getContent());
        $this->assertSame(200, $r->getStatusCode());
    }
}
