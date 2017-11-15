<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 13/11/2017
 * Time: 19:52
 */

namespace tests\AppBundle\Service;

use AppBundle\Entity\Commande;
use AppBundle\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LimitPerDayTest extends KernelTestCase
{
    private $limitPerDay;


    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->limitPerDay = $kernel->getContainer()
            ->get('app.limitPerDay');
    }

    /**
     * @dataProvider dateTested
     */
    public function testLimitPerDay($dateDeVisite, $expectedResult)
    {
        $commande = new Commande();
        $ticketA = new Ticket();
        $ticketB = new Ticket();
        $commande->addTicket($ticketA);
        $commande->addTicket($ticketB);
        $dateDeVisite = new \DateTime($dateDeVisite);
        $commande->setDateDeVisite($dateDeVisite);
        $value = $this->limitPerDay->limitPerDay($commande);
        $this->assertEquals($expectedResult, $value );
    }

    public function dateTested()
    {
        return [
            ['2017-06-11', TRUE],
        ];
    }


}
