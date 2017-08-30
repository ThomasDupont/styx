<?php

namespace Tests\WebserviceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    /*
    public function testSimpleTest()
    {
        $client = static::createClient();

        $client->request('GET', 'http://localhost:8000/api/post/');
        $r = $client->getResponse();
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame('application/json', $r->headers->get('Content-Type'));
        $this->assertEquals('{"message":"bonjour"}', $r->getContent());
        $this->assertNotEmpty($client->getResponse()->getContent());
    }
    */
    public function testGetPosts()
    {
        $client = static::createClient();
        $client->request('GET', 'http://localhost:8000/api/post/list/poll', [
            'apikey' => "59109a8ab3a9a",
            'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1",
            'zone' => 0,
            'from' => 0,
            'size' => 10
        ]);
        $r = $client->getResponse();
        var_dump($r->getContent());
        $client->request('GET', 'http://localhost:8000/api/post/list/news', [
            'apikey' => "59109a8ab3a9a",
            'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1",
            'zone' => 0,
            'from' => 0,
            'size' => 10
        ]);
        $r = $client->getResponse();
        var_dump($r->getContent());
        $client->request('GET', 'http://localhost:8000/api/post/list/event', [
            'apikey' => "59109a8ab3a9a",
            'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1",
            'zone' => 0,
            'from' => 0,
            'size' => 10
        ]);
        $r = $client->getResponse();
        var_dump($r->getContent());
        $client->request('GET', 'http://localhost:8000/api/post/list/all', [
            'apikey' => "59109a8ab3a9a",
            'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1",
            'zone' => 0,
            'from' => 0,
            'size' => 10
        ]);
        $r = $client->getResponse();
        var_dump($r->getContent());
    }
    /*
    public function testInsertionPollPost()
    {
        $client = static::createClient();
        $client->request('PUT', 'http://localhost:8000/api/post/action/poll', [
            'apikey' => "59109a8ab3a9a",
            'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1",
            'post' => [
                'title' => 'bonjour',
                'description' => 'mon bonjour',
                'question' => "Comment ça va?",
                'maxAnswer' => 10
            ],
            'zone' => 0 //Orléans
        ]);
        $r = $client->getResponse();
        $this->assertEquals('{"success":false,"message":"invalide request"}', $r->getContent());
    }

    public function testInsertionEventPost()
    {
        $client = static::createClient();
        $client->request('PUT', 'http://localhost:8000/api/post/action/event', [
            'apikey' => "59109a8ab3a9a",
            'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1",
            'post' => [
                'title' => 'bonjour',
                'description' => 'mon bonjour',
                'date' => "2005-08-15T15:52:01+0000",
                'place' => "Paris",
                'avatar' => "c'est quoi un avatar?"
            ],
            'zone' => 0 //Orléans
        ]);
        $r = $client->getResponse();
        $this->assertEquals('{"success":false,"message":"invalide request"}', $r->getContent());
    }

    public function testInsertionNewsPost()
    {
        $client = static::createClient();
        $client->request('PUT', 'http://localhost:8000/api/post/action/news', [
            'apikey' => "59109a8ab3a9a",
            'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1",
            'post' => [
                'title' => 'flash info',
                'description' => 'super flash info',
            ],
            'zone' => 0 //Orléans
        ]);
        $r = $client->getResponse();
        $this->assertEquals('{"success":false,"message":"invalide request"}', $r->getContent());
    }

    public function testCreateComment()
    {
        $client = static::createClient();
        $client->request('PUT', 'http://localhost:8000/api/comment/8', [
            'apikey' => "59109a8ab3a9a",
            'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1",
            'comment' => "bijour c'est la hotline di orange"
        ]);
        $r = $client->getResponse();
        var_dump($r->getContent());
    }
    */
    public function testGetComment()
    {
        $client = static::createClient();
        $client->request('GET', 'http://localhost:8000/api/comment/8', [
            'apikey' => "59109a8ab3a9a",
            'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1",
            'from' => 0,
            'size' => 10
        ]);
        $r = $client->getResponse();
        var_dump($r->getContent());
    }
    /*
        public function testUpdatePost()
        {
            $client = static::createClient();
            $client->request('POST', 'http://localhost:8000/api/post/8', [
                'apikey' => "59109a8ab3a9a",
                'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1",
                'type' => "poll",
                'question' => "Si ou la hotline de irange?"
            ]);
            $r = $client->getResponse();
            var_dump($r->getContent());
        }

        public function testUpdateComment()
        {
            $client = static::createClient();
            $client->request('POST', 'http://localhost:8000/api/comment/1', [
                'apikey' => "59109a8ab3a9a",
                'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1",
                'comment' => "Li hotline di irange est là sidi",
            ]);
            $r = $client->getResponse();
            var_dump($r->getContent());
        }

        public function testDeleteComment()
        {
            $client = static::createClient();
            $client->request('DELETE', 'http://localhost:8000/api/comment/1', [
                'apikey' => "59109a8ab3a9a",
                'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1"
            ]);
            $r = $client->getResponse();
            var_dump($r->getContent());
        }
        public function testDeletePost()
        {
            $client = static::createClient();
            $client->request('DELETE', 'http://localhost:8000/api/post/14', [
                'apikey' => "59109a8ab3a9a",
                'secret' => "e1b5d1d6fab187e822819e4357233b54be385fe91bde3adf95606fa773532b508265df8f6d4afcda60f94a06c2fb69861629b7da4d246bc9bcddd1104a2685c1"
            ]);
            $r = $client->getResponse();
            var_dump($r->getContent());
        }
    */
}
