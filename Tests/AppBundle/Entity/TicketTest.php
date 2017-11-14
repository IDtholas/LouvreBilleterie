<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 13/11/2017
 * Time: 16:18
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Commande;
use AppBundle\Entity\Ticket;
use PHPUnit\Framework\TestCase;


class TicketTest extends TestCase
{
    public function testSetNomTicket()
    {
        $ticket = new Ticket();
        $valeur = 'nomTicket';
        $ticket->setNomTicket($valeur);
        $this->assertEquals($valeur, $ticket->getNomTicket());
    }

    public function testSetPrenomTicket()
    {
        $ticket = new Ticket();
        $valeur = 'prenomTicket';
        $ticket->setPrenomTicket($valeur);
        $this->assertEquals($valeur, $ticket->getPrenomTicket());
    }


    public function testSetPays()
    {
        $ticket = new Ticket();
        $valeur = 'pays';
        $ticket->setPays($valeur);
        $this->assertEquals($valeur, $ticket->getPays());
    }

    public function testSetDateDeNaissance()
    {
        $ticket = new Ticket();
        $valeur = new \DateTime();
        $ticket->setDateDeNaissance($valeur);
        $this->assertEquals($valeur, $ticket->getDateDeNaissance());
    }

    public function testSetPrix()
    {
        $ticket = new Ticket();
        $valeur = '11';
        $ticket->setPrix($valeur);
        $this->assertEquals($valeur, $ticket->getPrix());
    }

    public function testSetTarif()
    {
        $ticket = new Ticket();
        $valeur = TRUE;
        $ticket->setTarif($valeur);
        $this->assertEquals($valeur, $ticket->getTarif());
    }

    public function testSetCommande()
    {
        $ticket = new Ticket();
        $commande = new Commande();
        $ticket->setCommande($commande);
        $this->assertEquals($commande, $ticket->getCommande());
    }

}