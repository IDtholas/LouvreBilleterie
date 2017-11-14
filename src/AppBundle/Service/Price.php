<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 08/11/2017
 * Time: 15:46
 */

namespace AppBundle\Service;


/**
 * Class Price
 * @package AppBundle\Service
 */
class Price
{
    /**
     * @param $commande
     * @return mixed
     */
    public function computePrice($commande)
    {
        $tickets = $commande->getTickets();
        $prixCommande = 0;


        foreach ($tickets as $ticket) {
            $age = date_diff($ticket->getDateDeNaissance(), $commande->getDateDeVisite())->y;

            switch ($age) {
                case $age > 4 && $age < 12:
                    $ticket->setPrix(8);
                    break;
                case $age < 4:
                    $ticket->setPrix(0);
                    break;
                case $age >= 60:
                    $ticket->setPrix(12);
                    break;
                default:
                    $ticket->setPrix(16);
                    break;
            }

            if($ticket->getTarif()){
                $ticket->setPrix(10);}

            if ($commande->getTypeTicket() === 'Demi journée') {
                $prix = $ticket->getPrix();
                $prixFinal = ($prix / 2);
                $ticket->setPrix($prixFinal);

            }
            $prixCommande += $ticket->getPrix();
            $ticket->setCommande($commande);
        }

        $commande->setPrixCommande($prixCommande);

        return $commande;


    }

}