<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 14:50
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;

class Afternoon extends Constraint
{
    public $message = "La date de visite ne peut être pour un jour antérieur, ou le même jour une fois 14h passé.";

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

}