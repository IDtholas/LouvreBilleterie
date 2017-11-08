<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 08/11/2017
 * Time: 20:29
 */

namespace AppBundle\Service;

use AppBundle\Entity\Ticket;

use Doctrine\ORM\EntityManager;

class LimitPerDay
{
    protected $doctrine;

    public function __construct(EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;

    }

    public function limitPerDay($commande)
    {
        $nbTicketSaved = count($this->doctrine->getRepository(Ticket::class)->getTicketByDay($commande->getDateDeVisite()));
        $nbTicketOrdered = count($commande->getTickets());

        $nbTicketByDay = $nbTicketSaved + $nbTicketOrdered;

        if($nbTicketByDay < 1000)
            {return TRUE;}
        else
            {return FALSE;}


    }

}