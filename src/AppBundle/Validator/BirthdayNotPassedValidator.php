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

/**
 * Class BirthdayNotPassedValidator
 * @package AppBundle\Validator
 */
class BirthdayNotPassedValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
       $date = new \DateTime();

       if ($date < $value)
       {$this->context->buildViolation($constraint->message)
           ->addViolation();}
    }


}