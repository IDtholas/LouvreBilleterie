<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 19/11/2017
 * Time: 16:29
 */

namespace tests\AppBundle\Validator;


use AppBundle\Validator\PastDays;
use AppBundle\Validator\PastDaysValidator;
use PHPUnit\Framework\TestCase;

class PastDaysTest extends TestCase
{
    public function testHoliday()
    {
        $constraints = new PastDays();
        $value = $constraints->validatedBy();
        $this->assertEquals(PastDaysValidator::class, $value);

    }

}