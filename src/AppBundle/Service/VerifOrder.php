<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 19/11/2017
 * Time: 16:25
 */

namespace AppBundle\Service;

use AppBundle\Entity\Commande;

/**
 * Class VerifOrder
 * @package AppBundle\Service
 */
class VerifOrder
{

    /**
     * @param Commande $commande
     * @return bool
     */
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