<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 15:06
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;


class BirthdayNotPassed extends Constraint
{
    public $message = 'La date de naissance rentrée ne peut pas être future.';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

}