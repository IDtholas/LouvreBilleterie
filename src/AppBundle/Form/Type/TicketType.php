<?php


namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Class TicketType
 * @package AppBundle\Form\Type
 */
class TicketType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomTicket', TextType::class, [
            'constraints' => [
                new NotBlank(),
                new Type('string'),
                new Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => "Le nom doit contenir au moins 2 caractères.",
                    'maxMessage' => "Le nom ne peux contenir plus de 50 caractères."
                ])],
            'label' => 'Nom :',])
            ->add('prenomTicket', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => "Le prénom doit contenir au moins 2 caractères.",
                        'maxMessage' => "Le prénom ne peux contenir plus de 50 caractères."
                    ])],
                'label' => 'Prénom :',])
            ->add('pays', CountryType::class, [
                'label' => 'Pays :',
            ])
            ->add('tarif', ChoiceType::class, array(
                'label' => 'Tarif réduit :',
                'choices' => array('oui' => TRUE, 'non' => FALSE)
            ))
            ->add('dateDeNaissance', DateType::class,[
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'Date de naissance :',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'html5' => false,
                'attr' => [
                    'class' => 'datepicker_birth',
                    'placeholder' => 'JJ-MM-AAAA',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ticket'
        ));
    }
}
