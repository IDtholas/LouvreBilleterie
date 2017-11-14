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

/**
 * Class ClosedMuseumValidator
 * @package AppBundle\Validator
 */
class ClosedMuseumValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $closedDays = ['Tue', 'Sun'];
        $day = date('D', $value->getTimeStamp());
        foreach( $closedDays as $closedDay) {
            if ($day === $closedDay) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }

        }
    }


}