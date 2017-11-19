<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 19/11/2017
 * Time: 14:04
 */

namespace AppBundle\Service;

use AppBundle\Entity\Commande;


class VerifOrder
{
    public function verifPastDate(Commande $commande)
    {
        $currentDay = date('d/m/y', $commande->getDateDeCommande()->getTimeStamp());
        $reservationDay = date('d/m/y', $commande->getDateDeVisite()->getTimeStamp());

        if( $currentDay > $reservationDay)
        {
            return true ;
        }
        else
        {
            return false;
        }
    }

    public function verifAfternoon(Commande $commande)
    {
        $currentDay = date('d/m/y', $commande->getDateDeCommande()->getTimeStamp());
        $reservationDay = date('d/m/y', $commande->getDateDeVisite()->getTimeStamp());
        $reservationHours = date("H", $commande->getDateDeCommande()->getTimestamp());

        if($currentDay === $reservationDay && $reservationHours >= 13 && $commande->getTypeTicket()==='Journée Entière')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}