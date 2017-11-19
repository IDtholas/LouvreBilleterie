<?php
namespace AppBundle\Form\Type;


use AppBundle\Validator\ClosedMuseum;
use AppBundle\Validator\Holiday;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints;

/**
 * Class DebutCommandeType
 * @package AppBundle\Form\Type
 */
class DebutCommandeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, [
            'constraints' => [
                new NotBlank(),
                new Type('string'),
                new Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => "Le nom doit contenir au moins 2 caractères.",
                    'maxMessage' => "Le nom ne peux contenir plus de 50 caractères."
                ])]])
            ->add('prenom', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => "Le prénom doit contenir au moins 2 caractères.",
                        'maxMessage' => "Le prénom ne peux contenir plus de 50 caractères."
                    ])]])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Constraints\Email()
                ],
            ])
            ->add('dateDeVisite', DateType::class,[
                'constraints' => [
                    new NotBlank(),
                    new ClosedMuseum(),
                    new Holiday(),
                ],
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'html5' => false,
                'label' => 'Date de visite :',
                'attr' => [
                    'class' => 'datepicker_js',
                ],
            ])
            ->add('typeTicket', ChoiceType::class, array(
                'choices' => array(
                    'Journée entière' => "Journée Entière",
                    'Demi journée' => "Demi journée"
                )))
        ;
    }
}
