<?php

namespace App\Form;

use App\Entity\Transaction;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Budget;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Dropdown voor entity selectie
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;   // Dropdown voor keuzes
use Symfony\Component\Form\Extension\Core\Type\DateType;     // Datum veld
use Symfony\Component\Form\Extension\Core\Type\TextareaType; // Lange tekst / notities
use Symfony\Component\Form\Extension\Core\Type\TextType;     // Korte tekst
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;       // Form opties stellen

class TransactionType extends AbstractType
{
    // Form opbouwen voor Transaction entity
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Bedrag invoeren
            ->add('amount', TextType::class, [
                'label' => 'Bedrag (€)',
                'attr' => [ //attributen
                    'class' => 'form-control',
                    'placeholder' => 'Voer het bedrag in...'
                ],
            ])
            // Type transactie kiezen: inkomen of uitgave
            ->add('type', ChoiceType::class, [
                'label' => 'Type transactie',
                'choices' => [
                    'Inkomen' => 'income',
                    'Uitgave' => 'expense',
                ],
                'attr' => ['class' => 'form-select'],
                'placeholder' => 'Selecteer type',
            ])
            // Datum van transactie
            ->add('date', DateType::class, [
                'widget' => 'single_text',       // Tekstveld met datumpicker
                'label' => 'Datum',
                'attr' => ['class' => 'form-control'],
            ])
            // Optionele notitie
            ->add('note', TextareaType::class, [
                'label' => 'Notitie',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder' => 'Voeg een korte notitie toe...'
                ],
            ])
            // Gebruiker koppelen
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',         // Dropdown toont gebruikersnaam
                'placeholder' => 'Selecteer gebruiker',
                'label' => 'Gebruiker',
                'attr' => ['class' => 'form-select'],
            ])
            // Categorie koppelen
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',         // Dropdown toont categorienaam
                'placeholder' => 'Selecteer categorie',
                'label' => 'Categorie',
                'attr' => ['class' => 'form-select'],
            ])
            // Budget koppelen
            ->add('budget', EntityType::class, [
                'class' => Budget::class,
                'choice_label' => function (Budget $budget) {
                    // Dropdown toont categorie + bedrag
                    return $budget->getCategory()->getName() . ' - €' . $budget->getAmount();
                },
                'placeholder' => 'Selecteer budget',
                'label' => 'Budget',
                'attr' => ['class' => 'form-select'],
            ]);
    }

    // Instellingen voor het form en entity koppeling
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class, // Dit formulier werkt met de Transaction entity
        ]);
    }
}
