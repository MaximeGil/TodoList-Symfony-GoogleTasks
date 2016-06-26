<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AuthenticationController extends WebTestCase {

    public function setUp() {
        $this->client = static::createClient();
    }

    public function testCallback() {


        $crawler = $this->client->request('GET', '/callback');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testDisconnect() {

        $crawler = $this->client->request('GET', '/google/logout');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

}
