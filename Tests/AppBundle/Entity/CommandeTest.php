<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 13/11/2017
 * Time: 14:26
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Commande;
use AppBundle\Entity\Ticket;
use PHPUnit\Framework\TestCase;

class CommandeTest extends TestCase
{
    public function testSetNom()
    {
        $commande = new Commande();
        $valeur = 'nom';
        $commande->setNom($valeur);
        $this->assertEquals($valeur, $commande->getNom());
    }

    public function testSetResa()
    {
        $commande = new Commande();
        $valeur = 'resa';
        $commande->setResa($valeur);
        $this->assertEquals($valeur, $commande->getResa());
    }

    public function testSetPrenom()
    {
        $commande = new Commande();
        $valeur = 'prenom';
        $commande->setPrenom($valeur);
        $this->assertEquals($valeur, $commande->getPrenom());
    }

    public function testSetEmail()
    {
        $commande = new Commande();
        $valeur = 'email';
        $commande->setEmail($valeur);
        $this->assertEquals($valeur, $commande->getEmail());
    }

    public function testSetTypeTicket()
    {
        $commande = new Commande();
        $valeur = 'Demi journee';
        $commande->setTypeTicket($valeur);
        $this->assertEquals($valeur, $commande->getTypeTicket());
    }

    public function testSetPrixCommande()
    {
        $commande = new Commande();
        $valeur = '16';
        $commande->setPrixCommande($valeur);
        $this->assertEquals($valeur, $commande->getPrixCommande());
    }

    public function testSetDateDeVisite()
    {
        $commande = new Commande();
        $valeur = new \DateTime();
        $commande->setDateDeVisite($valeur);
        $this->assertEquals($valeur, $commande->getDateDeVisite());
    }

    public function testSetDateDeCommande()
    {
        $commande = new Commande();
        $valeur = new \DateTime();
        $commande->setDateDeCommande($valeur);
        $this->assertEquals($valeur, $commande->getDateDeCommande());
    }

    public function testAddTickets()
    {
        $commande = new Commande();
        $ticket = new Ticket();
        $valeur = new \Doctrine\Common\Collections\ArrayCollection();
        $valeur[]=  $ticket;
        $commande->addTicket($ticket);
        $this->assertEquals($valeur, $commande->getTickets());
    }

    public function testRemoveTickets()
    {
        $commande = new Commande();
        $ticket = new Ticket();
        $valeur = new \Doctrine\Common\Collections\ArrayCollection();
        $commande->addTicket($ticket);
        $commande->removeTicket($ticket);
        $this->assertEquals($valeur, $commande->getTickets());
    }






}