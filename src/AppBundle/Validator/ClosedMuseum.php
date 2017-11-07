<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 14:40
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;

class ClosedMuseum extends Constraint
{

    public $message = "Le musée du Louvre est fermé le mardi, merci de choisir un autre jour.";

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }


}