<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    // Form opbouwen voor User entity
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Naam veld
            ->add('name', TextType::class, [
                'label' => 'Name',                       // Label voor gebruiker
                'attr' => ['class' => 'form-control']    // HTML class voor styling
            ])
            // Email veld
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'form-control']
            ]);
//            // Submit knop
//            ->add('submit', SubmitType::class, [
//                'label' => 'Create Account',             // Knop tekst
//                'attr' => ['class' => 'btn btn-primary mt-3'] // Bootstrap styling
//            ]);
  }

    // Form instellingen en entity koppeling
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class, // Form werkt met User entity
        ]);
    }
}
