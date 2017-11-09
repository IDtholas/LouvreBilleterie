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

/**
 * Class AfternoonValidator
 * @package AppBundle\Validator
 */
class AfternoonValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $currentDate = new \DateTime();
        $currentDay = date('d/m', $currentDate->getTimeStamp());

        $reservationDay = date('d/m', $value->getTimeStamp());

        $reservationHours = date("H", $currentDate->getTimestamp());
        if ($currentDay === $reservationDay && $reservationHours > 13) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }

    }


}