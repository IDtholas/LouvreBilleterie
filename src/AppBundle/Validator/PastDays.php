<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 07/11/2017
 * Time: 13:30
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * Class PastDays
 * @package AppBundle\Validator
 */
class PastDays extends Constraint
{
    /**
     * @var string
     */
    public $message = "La date de visite ne peut être une date antérieure à la date actuelle.";

    /**
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

}
