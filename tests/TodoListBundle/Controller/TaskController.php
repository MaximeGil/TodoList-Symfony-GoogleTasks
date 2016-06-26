<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskController extends WebTestCase {

    public function setUp() {
        $this->client = static::createClient();
    }

    public function testTaskDelete() {

        $crawler = $this->client->request('GET', '/google/list/42/task/delete/42');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testTaskAdd() {
        $crawler = $this->client->request('GET', '/google/task/add/42');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

}
