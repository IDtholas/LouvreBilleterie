<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 13/11/2017
 * Time: 16:34
 */

namespace tests\AppBundle\Service;

use AppBundle\Entity\Commande;
use AppBundle\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PriceTest extends KernelTestCase
{
    private $price;


    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->price = $kernel->getContainer()
            ->get('app.price');
    }

    /**
     * @param $naissance
     * @param $tarifReduit
     * @param $expectedPrice
     * @dataProvider pricesToTest
     */
    public function testPrice($naissance,$tarifReduit, $typeTicket, $expectedPrice)
    {
        $commande = new Commande();
        $ticket = new Ticket();
        $dateDeNaissance = new \DateTime($naissance);
        $dateDeVisite = new \DateTime('2018-01-01');
        $ticket->setDateDeNaissance($dateDeNaissance);
        $ticket->setTarif($tarifReduit);
        $commande->setTypeTicket($typeTicket);
        $commande->setDateDeVisite($dateDeVisite);
        $commande->addTicket($ticket);

        $this->price->computePrice($commande);
        $this->assertEquals($expectedPrice, $commande->getPrixCommande());

    }

    public function pricesToTest()
    {
        return [
            ['1900-01-01', FALSE, 'Journée Entière',  '12'],
            ['2010-01-01', FALSE, 'Journée Entière', '8'],
            ['2015-01-01', FALSE, 'Journée Entière', '0'],
            ['1989-07-07', FALSE, 'Journée Entière', '16'],
            ['1989-07-07', FALSE, 'Demi journée', '8'],
            ['1989-07-07', TRUE, 'Journée Entière', '10']
        ];
    }
}