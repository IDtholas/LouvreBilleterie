<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use AppBundle\Form\CommandeType;
use AppBundle\Form\DebutCommandeType;
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
            $prixCommande = 0;


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
                $prixCommande = $prixCommande + $ticket->getPrix();
            }

            $commande->setPrixCommande($prixCommande);

            $session = $request->getSession();
            $session->set('commande', $commande);


            return $this->render('prepare.html.twig', array('commande' => $commande));
        }

        return $this->render('ticket.html.twig', array('form' => $form->createView(), 'commande' => $commande));
    }

    public function confirmationAction()
    {
        return $this->render('confirmation.html.twig');
    }

    public function prepareAction()
    {
        return $this->render('prepare.html.twig');
    }

    public function checkoutAction(Request $request)
    {
        \Stripe\Stripe::setApiKey("sk_test_WPX5jeaspbkxlevLcL8Izm32");


        $token = $_POST['stripeToken'];

        $session = $request->getSession();
        $commande = $session->get('commande');

        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $commande->getPrixCommande() * 100, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - Billeterie Louvre"
            ));
            $this->addFlash("success","Bravo ça marche !");

            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();

            //envoie d'email de confirmation
            return $this->redirectToRoute("louvre_confirmation");

        } catch(\Stripe\Error\Card $e) {

            $this->addFlash("error","Snif ça marche pas :(");
            return $this->redirectToRoute("louvre_confirmation");
        }
    }

}
