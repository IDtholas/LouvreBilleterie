<?php
namespace AppBundle\Form;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints;

class DebutCommandeType extends AbstractType
{
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
            ->add('dateDeVisite', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('typeTicket', ChoiceType::class, array(
                'choices' => array(
                    'Journée entière' => "Journée Entière",
                    'Demi journée' => "Demi journée"
                )))
        ;
    }
}