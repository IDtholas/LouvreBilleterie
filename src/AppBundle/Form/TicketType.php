<?php


namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class TicketType extends AbstractType
{
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
                ])]])
            ->add('prenomTicket', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Type('string'),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => "Le prénom doit contenir au moins 2 caractères.",
                        'maxMessage' => "Le prénom ne peux contenir plus de 50 caractères."
                    ])]])
            ->add('pays', CountryType::class)
            ->add('tarif', ChoiceType::class, array(
                'label' => 'Tarif réduit',
                'choices' => array('oui' => TRUE, 'non' => FALSE)
            ))
            ->add('dateDeNaissance', DateType::class, [
                'widget' => 'single_text'
            ],[
                'constraints' => [
                    new Type('datetime'),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ticket'
        ));
    }
}