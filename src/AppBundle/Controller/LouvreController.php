<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use AppBundle\Entity\Ticket;
use AppBundle\Form\CommandeType;
use AppBundle\Form\DebutCommandeType;
use AppBundle\Form\SearchOrderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM;

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

        if($form->isSubmitted() && $form->isValid()) {

            $nbTicketSaved = count($this->getDoctrine()->getRepository(Ticket::class)->getTicketByDay($commande->getDateDeVisite()));
            $nbTicketOrdered = count($commande->getTickets());

            if (($nbTicketSaved + $nbTicketOrdered) < 1000) {

                $price = $this->get('app.price');
                $commandePleine = $price->computePrice($commande);

                $session = $request->getSession();
                $session->set('commande', $commandePleine);


                return $this->render('prepare.html.twig', array('commande' => $commandePleine));
            }

            $this->addFlash("error","Il ne reste plus assez de places disponibles pour ce jour.");
            return $this->render('ticket.html.twig', array('form' => $form->createView(), 'commande' => $commande));


        }

        return $this->render('ticket.html.twig', array('form' => $form->createView(), 'commande' => $commande));
    }

    public function confirmationAction()
    {
        return $this->render('confirmation.html.twig');
    }

    public function checkoutAction(Request $request)
    {
        \Stripe\Stripe::setApiKey($this->getParameter('skapikey'));


        $token = $request->request->get('stripeToken');

        $session = $request->getSession();
        $commande = $session->get('commande');

        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $commande->getPrixCommande() * 100, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - Billeterie Louvre"
            ));
            $this->addFlash("success","Le paiement est un succès.");

            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();

            //envoie d'email de confirmation
            return $this->redirectToRoute("louvre_confirmation");

        } catch(\Stripe\Error\Card $e) {

            $this->addFlash("error","Le paiement a échoué, merci de recommencer.");
            return $this->render('prepare.html.twig', array('commande' => $commande));
        }
    }

    public function informationsAction()
    {
        return $this->render('informations.html.twig');
    }

    public function aideAction()
    {
        return $this->render('aide.html.twig');
    }

    public function retrieveAction(Request $request)
    {
        $commande = New Commande();
        $form = $this->createForm(SearchOrderType::class, $commande);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $commandesPassees = $this->getDoctrine()->getRepository(Commande::class)->findBy(array('email' => $commande->getEmail(), 'nom' => $commande->getNom(), 'prenom' => $commande->getPrenom()));

            return $this->render('retrievedOrder.html.twig', array('commandesPassees' => $commandesPassees, 'commande' => $commande));
        }

        return $this->render('retrieveOrder.html.twig', array('form' => $form->createView(), 'commande' => $commande));
    }

}
