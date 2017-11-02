<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use AppBundle\Form\CommandeType;
use AppBundle\Form\DebutCommandeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LouvreController extends Controller
{
    public function accueilAction()
    {
        return $this->render('accueil.html.twig');
    }

    public function commandeAction(Request $request)
    {
        $commandeEnSession = new Commande();

        $form = $this->createForm(DebutCommandeType::class, $commandeEnSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session = $request->getSession();
            $session->set('commande', $commandeEnSession);


            return $this->redirectToRoute('louvre_ticket');
        }

        return $this->render('commande.html.twig', array('form' => $form->createView()));
    }

    public function ticketAction(Request $request)
    {
        $session = $request->getSession();
        $commande = $session->get('commande');

        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $tickets = $commande->getTickets();


            foreach ($tickets as $ticket)
            {
                $age = date_diff( $ticket->getDateDeNaissance(), $commande->getDateDeVisite())->y;

                switch ($age) {
                    case $age > 4 && $age < 12:
                        $ticket->setPrix(8) ;
                        break;
                    case $age < 4:
                        $ticket->setPrix(0);
                        break;
                    case $age >= 60:
                        $ticket->setPrix(12);
                        break;
                    case $ticket->getTarif() === TRUE :
                        $ticket->setPrix(10);
                        break;
                    default:
                        $ticket->setPrix(16);
                        break;
                }

                if ($commande->getTypeTicket() === 'Demi journée')
                {
                    $prix = $ticket->getPrix();
                    $prixFinal = ($prix/2);
                    $ticket->setPrix($prixFinal);

                }
            }

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($commande);
            $em->flush();


            return $this->redirectToRoute('louvre_accueil');
        }

        return $this->render('ticket.html.twig', array('form' => $form->createView(), 'commande' => $commande));
    }
}
