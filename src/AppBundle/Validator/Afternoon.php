<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 14:50
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * Class Afternoon
 * @package AppBundle\Validator
 */
class Afternoon extends Constraint
{
    /**
     * @var string
     */
    public $message = "La date de visite ne peut être pour le même jour une fois 14h passé.";

    /**
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

}