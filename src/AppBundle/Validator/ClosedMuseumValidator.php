<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 14:46
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ClosedMuseumValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $closedDays = 'Tue';
        $day = date('D', $value->getTimeStamp());
            if ($day === $closedDays) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }

    }


}