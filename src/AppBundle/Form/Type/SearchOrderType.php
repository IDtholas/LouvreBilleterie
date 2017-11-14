<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 08/11/2017
 * Time: 10:33
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class SearchOrderType
 * @package AppBundle\Form\Type
 */
class SearchOrderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email utilisée lors de la commande :',
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom de la personne qui a passé la commande :',
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom de la personne qui a passé la commande :',
            ])
        ;
    }


}