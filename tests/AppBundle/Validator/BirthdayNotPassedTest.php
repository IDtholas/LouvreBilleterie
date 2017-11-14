<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 13/11/2017
 * Time: 23:10
 */

namespace tests\AppBundle\Validator;

use AppBundle\Validator\BirthdayNotPassed;
use AppBundle\Validator\BirthdayNotPassedValidator;
use PHPUnit\Framework\TestCase;

class BirthdayNotPassedTest extends TestCase
{
    public function testBirthdayNotPassed()
    {
        $constraints = new BirthdayNotPassed();
        $value = $constraints->validatedBy();
        $this->assertEquals(BirthdayNotPassedValidator::class, $value);

    }
}