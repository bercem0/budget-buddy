<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Form\TransactionType;
use App\Repository\TransactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractController
{
    // Pagina om alle transacties te zien
    #[Route('/transaction', name: 'app_transaction')]
    public function index(TransactionRepository $transactionRepository): Response
    {
        // Haal alle transacties uit de database
        // TransactionRepository = "depot", we halen alle transacties uit de database
        $transactions = $transactionRepository->findAll();

        // Stuur de transacties naar de Twig template
        return $this->render('transaction/index.html.twig', [
            'transactions' => $transactions,
        ]);
    }

    // Pagina om een nieuwe transactie toe te voegen
    #[Route('/transaction/new', name: 'transaction_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        // $request = alles wat de gebruiker naar de server stuurt, bijvoorbeeld formuliergegevens
        // EntityManager = de beheerder die met de database communiceert
        $transaction = new Transaction();

        // Maak een formulier voor de transactie
        $form = $this->createForm(TransactionType::class, $transaction);

        // Vul het formulier met de gegevens van $request
        // Hier controleert Symfony of het formulier is verzonden en vult de waarden in
        $form->handleRequest($request);

        // Als het formulier is ingediend en geldig
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($transaction); // klaar om op te slaan
            $em->flush();               // schrijf naar de database

            // Toon een succesbericht
            $this->addFlash('success', 'Transactie succesvol toegevoegd!');

            // Ga terug naar de lijst van transacties
            return $this->redirectToRoute('app_transaction');
        }

        // Toon het formulier als het nog niet is verzonden
        return $this->render('transaction/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // TRANSACTIE BEWERKEN (UPDATE)
    #[Route('/transaction/{id}/edit', name: 'transaction_edit')]
    public function edit(Transaction $transaction, Request $request, EntityManagerInterface $em): Response
    {
        // Maak een formulier voor de bestaande transactie
        $form = $this->createForm(TransactionType::class, $transaction);

        // Vul het formulier met de gegevens van $request
        $form->handleRequest($request);

        // Als het formulier is ingediend en geldig
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush(); // sla de wijzigingen in de database op
            $this->addFlash('success', 'Transactie succesvol bijgewerkt!');
            return $this->redirectToRoute('app_transaction');
        }

        // Toon het bewerkformulier
        return $this->render('transaction/edit.html.twig', [
            'form' => $form->createView(),
            'transaction' => $transaction,
        ]);
    }

    // TRANSACTIE VERWIJDEREN (DELETE)
    #[Route('/transaction/{id}/delete', name: 'transaction_delete', methods: ['POST'])]
    public function delete(Transaction $transaction, Request $request, EntityManagerInterface $em): Response
    {
        // Controleer of het CSRF-token geldig is
        if ($this->isCsrfTokenValid('delete' . $transaction->getId(), $request->request->get('_token'))) {
            $em->remove($transaction); // klaar om te verwijderen
            $em->flush();              // verwijder uit de database
            $this->addFlash('success', 'Transactie succesvol verwijderd!');
        }

        // Ga terug naar de lijst van transacties
        return $this->redirectToRoute('app_transaction');
    }
}
