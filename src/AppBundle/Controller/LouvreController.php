<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use AppBundle\Form\CommandeType;
use AppBundle\Form\DebutCommandeType;
use AppBundle\Form\SearchOrderType;
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

        if($form->isSubmitted() && $form->isValid()) {

            $nbTicketByDay = $this->get('app.limitPerDay')->limitPerDay($commande);

            if ($nbTicketByDay === TRUE ) {

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

    public function checkoutAction(Request $request)
    {

        $session = $request->getSession();
        $commande = $session->get('commande');

        $this->get('app.stripe')->chargeOrder($commande, $request);


        $em = $this->getDoctrine()->getManager();
        $em->persist($commande);
        $em->flush();

        //envoie d'email de confirmation
        return $this->render('confirmation.html.twig');
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
        $form = $this->createForm(SearchOrderType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $commandesPassees = $this->getDoctrine()->getRepository(Commande::class)->findBy(array('email' => $data['email'], 'nom' => $data['nom'], 'prenom' => $data['prenom']));

            return $this->render('retrievedOrder.html.twig', array('commandesPassees' => $commandesPassees, 'email' => $data['email'], 'nom' => $data['nom'], 'prenom' => $data['prenom']));
        }

        return $this->render('retrieveOrder.html.twig', array('form' => $form->createView()));
    }

}
