<?php

namespace App\Controller;

use App\Entity\Budget;
use App\Form\BudgetType;
use App\Repository\BudgetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BudgetController extends AbstractController
{
    // Dit is de pagina waar je alle budgetten ziet
    #[Route('/budget', name: 'app_budget')]
    public function index(BudgetRepository $budgetRepository): Response
    {
        // Haal alle budgetten uit de database
        $budgets = $budgetRepository->findAll();

        // Laat de budgetten zien in de pagina
        return $this->render('budget/index.html.twig', [
            'budgets' => $budgets,
        ]);
    }

    // Dit is de pagina om een nieuw budget toe te voegen
    #[Route('/budget/new', name: 'budget_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Maak een nieuw budget aan
        $budget = new Budget();

        // Maak een formulier voor het budget
        $form = $this->createForm(BudgetType::class, $budget);

        // Kijk of er iets ingevuld is in het formulier
        $form->handleRequest($request);

        // Als het formulier is ingevuld en klopt
        if ($form->isSubmitted() && $form->isValid()) {
            // Sla het budget op in de database
            $entityManager->persist($budget);
            $entityManager->flush();

            // Laat een bericht zien dat het gelukt is
            $this->addFlash('success', 'Budget is succesvol toegevoegd!');

            // Ga terug naar de lijst van budgetten
            return $this->redirectToRoute('app_budget');
        }

        // Laat het formulier zien als het nog niet is ingevuld
        return $this->render('budget/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
