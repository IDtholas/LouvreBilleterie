<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use AppBundle\Form\CommandeType;
use AppBundle\Form\DebutCommandeType;
use AppBundle\Form\SearchOrderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LouvreController
 * @package AppBundle\Controller
 */
class LouvreController extends Controller
{

    //render the home page
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction()
    {
        return $this->render('home.html.twig');
    }

    //render the order form, and when submitted and valid, redirect to the ticket form

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function commandeAction(Request $request)
    {
        $commandeInSession = new Commande();

        //order form created
        $form = $this->createForm(DebutCommandeType::class, $commandeInSession);
        $form->handleRequest($request);

        //if form submitted and valid, pass order in session then redirect to the ticket form
        if ($form->isSubmitted() && $form->isValid()) {
            $session = $request->getSession();
            $session->set('commande', $commandeInSession);


            return $this->redirectToRoute('louvre_ticket');
        }

        //if form not submitted, render an empty one
        return $this->render('commande.html.twig', array('form' => $form->createView()));
    }

    //render the ticket form, and when submitted and valid, render the prepare view

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ticketAction(Request $request)
    {
        //get order in session
        $session = $request->getSession();
        $commande = $session->get('commande');

        //create the collection Type form, for Ticket entity
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        //if form is submitted and valid, check 1000 ticket limit, compute each ticket price and order price, then pass full order in session
        if($form->isSubmitted() && $form->isValid()) {

            $nbTicketByDay = $this->get('app.limitPerDay')->limitPerDay($commande);

            if ($nbTicketByDay === TRUE ) {

                $price = $this->get('app.price');
                $commandePleine = $price->computePrice($commande);

                $session = $request->getSession();
                $session->set('commande', $commandePleine);


                return $this->render('prepare.html.twig', array('commande' => $commandePleine));
            }

            //if ticket limit is exceeded, render the form again with an error message
            $this->addFlash("error","Il ne reste plus assez de places disponibles pour ce jour.");
            return $this->render('ticket.html.twig', array('form' => $form->createView(), 'commande' => $commande));


        }

        //if form is not submitted, render an empty one
        return $this->render('ticket.html.twig', array('form' => $form->createView(), 'commande' => $commande));
    }

    //get full order in session, charge for it, persist and flush it, then send the confirmation mail and render the confirmation view

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function checkoutAction(Request $request)
    {

        // get full order in session
        $session = $request->getSession();
        $commande = $session->get('commande');

        //service to charge the card for the order
        $this->get('app.stripe')->chargeOrder($commande, $request);


        // uniqID set for reservation, persist and flush order in DB
        $commande->setResa(uniqid());
        $em = $this->getDoctrine()->getManager();
        $em->persist($commande);
        $em->flush();

        //send confirmation mail with reservation code

        $message = (new \Swift_Message('Mail de confirmation de Commande'))
            ->setFrom('webmaster@billetterie.com')
            ->setTo($commande->getEmail())
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'emailConfirmation.html.twig',
                    array('commande' => $commande)
                ),
                'text/html'
            );

        $mailer = $this->get('mailer');
        $mailer->send($message);

        return $this->render('confirmation.html.twig');
    }

    // render the informations view

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function informationsAction()
    {
        return $this->render('informations.html.twig');
    }

    //render the help view

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function helpAction()
    {
        return $this->render('help.html.twig');
    }

    // render a search form, and when submitted and valid, display the DB results

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function retrieveAction(Request $request)
    {
        $form = $this->createForm(SearchOrderType::class);
        $form->handleRequest($request);

        // if form submitted and valid, get its data, get the matching results in DB, the render them in view
        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $commandesPassees = $this->getDoctrine()->getRepository(Commande::class)->findBy(array('email' => $data['email'], 'nom' => $data['nom'], 'prenom' => $data['prenom']));

            return $this->render('retrievedOrder.html.twig', array('commandesPassees' => $commandesPassees, 'email' => $data['email'], 'nom' => $data['nom'], 'prenom' => $data['prenom']));
        }

        // if form isnt submitted, render an empty one
        return $this->render('retrieveOrder.html.twig', array('form' => $form->createView()));
    }

}
