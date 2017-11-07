<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 14:50
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;

class DemiJournee extends Constraint
{
    public $message = "Il n'est pas possible de commander pour le même jour 14h passé.";

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

}