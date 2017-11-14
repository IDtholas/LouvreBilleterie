<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 13/11/2017
 * Time: 20:43
 */

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class LouvreControllerTest extends WebTestCase
{
    public function testHomeIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testAideIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/aide');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testInformationsIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/informations');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testCommandeIsUp()
    {

        $client = static::createClient();
        $client->request('GET', '/commande');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testTicketIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/commande/ticket');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testCheckoutIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/commande/checkout');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testRetrieveIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/recuperationdecommande');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

}