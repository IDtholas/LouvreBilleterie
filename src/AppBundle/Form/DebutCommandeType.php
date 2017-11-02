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

class DebutCommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', EmailType::class)
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