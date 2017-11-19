<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use AppBundle\Form\Type\CommandeType;
use AppBundle\Form\Type\DebutCommandeType;
use AppBundle\Form\Type\SearchOrderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LouvreController
 * @package AppBundle\Controller
 */
class LouvreController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction()
    {
        return $this->render('home.html.twig');
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function commandeAction(Request $request)
    {
        $commande = new Commande();

        $form = $this->createForm(DebutCommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           $verif = $this->get('app.verifOrder');
            if($verif->verifAfternoon($commande))
            {
                $this->addFlash("error", "Il n'est pas possible de commander le billet journée entière après 14h.");
                return $this->redirectToRoute('louvre_commande');
            }

            $session = $request->getSession();
            $session->set('commande', $commande);


            return $this->redirectToRoute('louvre_ticket');
        }

        return $this->render('commande.html.twig', array('form' => $form->createView()));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ticketAction(Request $request)
    {
        $session = $request->getSession();
        $commande = $session->get('commande');

        if(isset($commande)) {

            $form = $this->createForm(CommandeType::class, $commande);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $nbTicketByDay = $this->get('app.limitPerDay')->limitPerDay($commande);

                if ($nbTicketByDay) {

                    $price = $this->get('app.price');
                    $commandePleine = $price->computePrice($commande);

                    $session = $request->getSession();
                    $session->set('commande', $commandePleine);


                    return $this->redirectToRoute('louvre_prepare');
                }

                $this->addFlash("error", "Il ne reste plus assez de places disponibles pour ce jour.");
                return $this->render('ticket.html.twig', array('form' => $form->createView(), 'commande' => $commande));


            }

            return $this->render('ticket.html.twig', array('form' => $form->createView(), 'commande' => $commande));
        }
        else
        {
            return $this->render('error.html.twig');
        }
    }


    public function prepareAction(Request $request)
    {
        $session = $request->getSession();
        $commande = $session->get('commande');

        if(isset($commande)) {
            return $this->render('prepare.html.twig', array('commande' => $commande));
        }
        else{
            return $this->render('error.html.twig');
        }

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function checkoutAction(Request $request)
    {
        $token = $request->request->get('stripeToken');

        if (isset($token)) {

            $session = $request->getSession();
            $commande = $session->get('commande');

            $this->get('app.stripe')->chargeOrder($commande, $token);


            $commande->setResa(uniqid());
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();


            $message = (new \Swift_Message('Mail de confirmation de Commande'))
                ->setFrom('webmaster@billetterie.com')
                ->setTo($commande->getEmail())
                ->setBody(
                    $this->renderView(
                        'emailConfirmation.html.twig',
                        array('commande' => $commande)
                    ),
                    'text/html'
                );

            $mailer = $this->get('mailer');
            $mailer->send($message);

            $session->set('commande', null);

            return $this->redirectToRoute('louvre_confirmation');
        }

        else{
            return $this->render('error.html.twig');
        }
    }


    public function confirmationAction()
    {
        return $this->render('confirmation.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function informationsAction()
    {
        return $this->render('informations.html.twig');
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function helpAction()
    {
        return $this->render('help.html.twig');
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchorderAction(Request $request)
    {
        $form = $this->createForm(SearchOrderType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $session = $request->getSession();
            $session->set('searchdata', $data);

            return $this->redirectToRoute('louvre_foundorder');
        }

        return $this->render('searchOrder.html.twig', array('form' => $form->createView()));
    }

    public function foundorderAction(Request $request)
    {
        $session = $request->getSession();
        $data = $session->get('searchdata');
        $session->set('searchdata', null);

        if(isset($data)) {
            $commandesPassees = $this->getDoctrine()->getRepository(Commande::class)->findBy(array('email' => $data['email'], 'nom' => $data['nom'], 'prenom' => $data['prenom']));


            return $this->render('foundOrder.html.twig', array('commandesPassees' => $commandesPassees, 'email' => $data['email'], 'nom' => $data['nom'], 'prenom' => $data['prenom']));
        }
        else
        {
            return $this->render('error.html.twig');
        }
    }

}
