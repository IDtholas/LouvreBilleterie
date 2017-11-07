<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 15:07
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class BirthdayNotPassedValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
       $date = new \DateTime();

       if ($date < $value)
       {$this->context->buildViolation($constraint->message)
           ->addViolation();}
    }


}