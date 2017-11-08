<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 08/11/2017
 * Time: 19:19
 */

namespace AppBundle\Service;

use Stripe\Charge;
use Stripe\Error\Card;
use Symfony\Component\HttpFoundation\Request;

class Stripe
{
    /**
     * @var string
     */
    protected $skapikey;

    /**
     * Stripe constructor.
     * @param $skapikey
     */
    public function __construct($skapikey)
    {
        $this->skapikey = $skapikey;
    }

    /**
     * @param $commande
     * @param Request $request
     */
    public function chargeOrder($commande, Request $request)
    {
        \Stripe\Stripe::setApiKey($this->skapikey);
        $token = $request->request->get('stripeToken');
        try {
            Charge::create(array(
                'amount' => $commande->getPrixCommande() * 100,
                'currency' => 'EUR',
                'source' => $token,
                'description' => 'Musée du Louvre - Billeterie',
            ));
        } catch (Card $e) {
            $e->getMessage();
        }
    }


}