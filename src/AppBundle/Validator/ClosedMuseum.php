<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 14:40
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * Class ClosedMuseum
 * @package AppBundle\Validator
 */
class ClosedMuseum extends Constraint
{

    /**
     * @var string
     */
    public $message = "Le musée du Louvre est fermé le mardi et le dimanche, merci de choisir un autre jour.";

    /**
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }


}
