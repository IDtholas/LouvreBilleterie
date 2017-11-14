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


/**
 * Class LimitPerDay
 * @package AppBundle\Service
 */
class LimitPerDay
{
    /**
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * LimitPerDay constructor.
     * @param EntityManager $doctrine
     */
    public function __construct(EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;

    }

    /**
     * @param $commande
     * @return bool
     */
    public function limitPerDay($commande)
    {
        $nbTicketSaved = count($this->doctrine->getRepository(Ticket::class)->getTicketByDay($commande->getDateDeVisite()));
        $nbTicketOrdered = count($commande->getTickets());

        $nbTicketByDay = $nbTicketSaved + $nbTicketOrdered;

        if($nbTicketByDay < 5)
            {return TRUE;}
        else
            {return FALSE;}


    }

}