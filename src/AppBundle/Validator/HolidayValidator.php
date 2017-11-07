<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 15:12
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class HolidayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $holidayDay = ['01/05', '01/11', '25/12'];
        $date = date('d/m', $value->getTimeStamp());
        foreach ($holidayDay as $holiday) {
            if ($date === $holiday) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }

    }

}