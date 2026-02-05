<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;      // E-mail veld
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;         // Form opties instellen

class ContactType extends AbstractType
{
    // Form opbouwen voor Contact entity
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Naam invoeren
            ->add('name', TextType::class, [
                'label' => 'Naam',                     // Form label
                'attr' => ['class' => 'form-control', 'placeholder' => 'Uw naam'] // HTML attributen
            ])
            // E-mailadres invoeren
            ->add('email', EmailType::class, [
                'label' => 'E-mailadres',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Uw e-mailadres']
            ])
            // Onderwerp van bericht invoeren
            ->add('subject', TextType::class, [
                'label' => 'Onderwerp',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Waarover gaat uw bericht?']
            ])
            // Bericht zelf invoeren
            ->add('message', TextareaType::class, [
                'label' => 'Bericht',
                'attr' => ['class' => 'form-control', 'rows' => 6, 'placeholder' => 'Typ hier uw bericht...']
            ]);
    }

    // Form instellingen en entity koppeling
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,  // Form werkt met Contact entity
        ]);
    }
}
