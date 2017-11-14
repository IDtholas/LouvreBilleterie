<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 13/11/2017
 * Time: 23:10
 */

namespace tests\AppBundle\Validator;

use AppBundle\Validator\ClosedMuseum;
use AppBundle\Validator\ClosedMuseumValidator;
use PHPUnit\Framework\TestCase;

class ClosedMuseumTest extends TestCase
{
    public function testClosedMuseum()
    {
        $constraints = new ClosedMuseum();
        $value = $constraints->validatedBy();
        $this->assertEquals(ClosedMuseumValidator::class, $value);

    }
}