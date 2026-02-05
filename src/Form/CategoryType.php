<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;    // Tekstveld voor naam
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;  // Dropdown voor kiezen
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;      // Form opties stellen

class CategoryType extends AbstractType
{
    // Form opbouwen voor Category entity
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Naam van de categorie invoeren
            ->add('name', TextType::class, [
                'label' => 'Category Name',    // Label dat de gebruiker ziet
            ])
            // Type van de categorie kiezen: inkomen of uitgave
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Income' => 'income',      // "Income" in de dropdown toont "income"
                    'Expense' => 'expense',    // "Expense" toont "expense"
                ],
                'label' => 'Category Type',    // Label dat de gebruiker ziet
            ]);
//            // Opslaan knop
//            ->add('save', SubmitType::class, [
//                'label' => 'Save Category',   // Knoptekst
//            ]);
    }

    // Instellingen voor het form, welke entity gebruikt wordt
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,   // Dit formulier werkt met de Category entity
        ]);
    }
}
