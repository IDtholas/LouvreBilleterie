<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 07/11/2017
 * Time: 13:30
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;

class PastDays extends Constraint
{
    public $message = "La date de visite ne peut être une date antérieure à la date actuelle.";

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

}