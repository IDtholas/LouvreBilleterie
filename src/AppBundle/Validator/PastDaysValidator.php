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
       $currentDay = date('d/m', $currentDate->getTimeStamp());
       $reservationDay = date('d/m', $value->getTimeStamp());

        if ($currentDay > $reservationDay)
        {$this->context->buildViolation($constraint->message)
            ->addViolation();}
    }

}