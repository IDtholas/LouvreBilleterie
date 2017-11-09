<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 15:06
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * Class BirthdayNotPassed
 * @package AppBundle\Validator
 */
class BirthdayNotPassed extends Constraint
{
    /**
     * @var string
     */
    public $message = 'La date de naissance entrée ne peut pas être future.';

    /**
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

}