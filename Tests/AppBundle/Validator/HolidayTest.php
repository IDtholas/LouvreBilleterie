<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 13/11/2017
 * Time: 23:10
 */

namespace Tests\AppBundle\Validator;

use AppBundle\Validator\Holiday;
use AppBundle\Validator\HolidayValidator;
use PHPUnit\Framework\TestCase;

class HolidayTest extends TestCase
{
    public function testHoliday()
    {
        $constraints = new Holiday();
        $value = $constraints->validatedBy();
        $this->assertEquals(HolidayValidator::class, $value);

    }
}