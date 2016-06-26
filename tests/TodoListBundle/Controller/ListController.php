<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListController extends WebTestCase {

    public function setUp() {
        $this->client = static::createClient();
    }

    public function testGoogle() {

        $crawler = $this->client->request('GET', '/google');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testList() {

        $crawler = $this->client->request('GET', '/google/list');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testListAdd() {

        $crawler = $this->client->request('GET', '/google/list/add');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testListDelete() {

        $crawler = $this->client->request('GET', '/google/list/delete/42');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testListUpdate() {

        $crawler = $this->client->request('GET', '/google/list/update/42');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testListShowItems() {

        $crawler = $this->client->request('GET', '/google/list/items/42');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }



}
