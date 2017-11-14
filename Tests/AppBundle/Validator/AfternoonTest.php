<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 13/11/2017
 * Time: 23:10
 */

namespace Tests\AppBundle\Validator;


use AppBundle\Validator\Afternoon;
use AppBundle\Validator\AfternoonValidator;
use PHPUnit\Framework\TestCase;

class AfternoonTest extends TestCase
{
    public function testAfternoon()
    {
        $constraints = new Afternoon();
        $value = $constraints->validatedBy();
        $this->assertEquals(AfternoonValidator::class, $value);

    }
}