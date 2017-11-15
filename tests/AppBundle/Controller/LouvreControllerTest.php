<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 13/11/2017
 * Time: 20:43
 */

namespace tests\AppBundle\Controller;


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

    public function testOrder()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/commande');

        $form = $crawler->selectButton('Commander')->form();
        $form['debut_commande[nom]'] = 'Drabczuk';
        $form['debut_commande[prenom]'] = 'Alexandre';
        $form['debut_commande[email]'] = 'alexandre.drabczuk@gmail.com';
        $form['debut_commande[dateDeVisite]'] = '31-01-2018';
        $form['debut_commande[typeTicket]'] = 'Demi journée';

        $client->submit($form);
        $client->followRedirect();
        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/commande/ticket');

        $form = $crawler->selectButton('Confirmez vos Tickets')->form();
        $values = array_merge_recursive(
            $form->getPhpValues(),
            array(
                'commande[tickets]' => array(
                    'tickets' => array(
                        array('commande[tickets][0][nomTicket]' => 'Drabczuk',
                            'commande[tickets][0][prenomTicket]' => 'Alexandre',
                            'commande[tickets][0][pays]' => 'FR',
                            'commande[tickets][0][tarif]' => 1,
                            'commande[tickets][0][dateDeNaissance]' => '12-07-1989'),
                    )
                )
            )
        );
        $client->request($form->getMethod(), $form->getUri(), $values, $form->getPhpFiles());
        $client->submit($form);
        $client->followRedirect();
        $this->assertSame(200, $client->getResponse()->getStatusCode());

    }



    public function testRetrieveIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/recuperationdecommande');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }


    public function testconfirmationIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/commande/confirmation');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}