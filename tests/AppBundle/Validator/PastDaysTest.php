<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 13/11/2017
 * Time: 23:10
 */

namespace tests\AppBundle\Validator;

use AppBundle\Validator\PastDays;
use AppBundle\Validator\PastDaysValidator;
use PHPUnit\Framework\TestCase;

class PastDaysTest extends TestCase
{
    public function testPastDays()
    {
        $constraints = new PastDays();
        $value = $constraints->validatedBy();
        $this->assertEquals(PastDaysValidator::class, $value);

    }
}