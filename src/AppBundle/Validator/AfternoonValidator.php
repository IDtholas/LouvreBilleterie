<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 14:53
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AfternoonValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $currentDate = new \DateTime();
        $currentDay = date('d/m', $currentDate->getTimeStamp());

        $reservationDay = date('d/m', $value->getTimeStamp());

        $reservationHours = date('H', $value->getTimeStamp());
        if ($currentDay === $reservationDay && $reservationHours > 14) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }

    }


}