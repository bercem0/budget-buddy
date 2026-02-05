<?php

namespace App\Form;

use App\Entity\Budget;
use App\Entity\Category;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;          // Dropdown voor een entity
use Symfony\Component\Form\AbstractType;                   // Basis formulier klasse
use Symfony\Component\Form\Extension\Core\Type\MoneyType;  // Geldveld invoeren
use Symfony\Component\Form\FormBuilderInterface;           // Velden toevoegen aan formulier
use Symfony\Component\OptionsResolver\OptionsResolver;     // Form opties instellen

class BudgetType extends AbstractType
{
    // Form opbouwen voor Budget entity
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Kies een gebruiker uit de database
            ->add('user', EntityType::class, [
                'class' => User::class,          // Gebruiker entity gebruiken
                'choice_label' => 'name',        // Toon de naam in de dropdown
                'label' => 'Gebruiker',          // Label dat de gebruiker ziet
            ])
            // Kies een categorie uit de database
            ->add('category', EntityType::class, [
                'class' => Category::class,      // Categorie entity gebruiken
                'choice_label' => 'name',        // Toon de naam van de categorie
                'label' => 'Categorie',          // Label voor het veld
            ])
            // Bedrag invoeren
            ->add('amount', MoneyType::class, [
                'currency' => 'EUR',             // Valuta = Euro
                'label' => 'Bedrag',             // Label dat de gebruiker ziet
            ]);
    }

    // Instellingen voor het form, welke entity gebruikt wordt
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Budget::class,       // Dit formulier werkt met de Budget entity
        ]);
    }
}
