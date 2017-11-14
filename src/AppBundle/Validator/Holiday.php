<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/11/2017
 * Time: 15:09
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * Class Holiday
 * @package AppBundle\Validator
 */
class Holiday extends Constraint
{
    /**
     * @var string
     */
    public $message = "Le musée du Louvre est fermé à la date sélectionné.";

    /**
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }


}
