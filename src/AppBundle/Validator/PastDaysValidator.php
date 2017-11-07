<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 07/11/2017
 * Time: 13:30
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PastDaysValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
       $currentDate = new \DateTime();

        if ($currentDate > $value)
        {$this->context->buildViolation($constraint->message)
            ->addViolation();}
    }

}