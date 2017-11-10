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

/**
 * Class PastDaysValidator
 * @package AppBundle\Validator
 */
class PastDaysValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
       $currentDate = new \DateTime();
       $currentDay = date('y/m/d', $currentDate->getTimeStamp());
       $reservationDay = date('y/m/d', $value->getTimeStamp());

        if ($currentDay > $reservationDay)
        {$this->context->buildViolation($constraint->message)
            ->addViolation();}
    }

}