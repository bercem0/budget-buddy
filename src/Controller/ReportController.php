<?php

namespace App\Controller;

use App\Repository\TransactionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    // Pagina om een overzicht van alle transacties en het saldo te zien
    #[Route('/report', name: 'app_report')]
    public function index(TransactionRepository $transactionRepository): Response
    {
        // Haal alle transacties uit de database
        $transactions = $transactionRepository->findAll();

        // Beginwaarden voor totaal inkomen en uitgaven
        $totalIncome = 0;
        $totalExpense = 0;

        // Loop door alle transacties om totaal inkomsten en uitgaven te berekenen
        foreach ($transactions as $transaction) {
            if ($transaction->getType() === 'income') {
                $totalIncome += $transaction->getAmount(); // Tel inkomsten op
            } elseif ($transaction->getType() === 'expense') {
                $totalExpense += $transaction->getAmount(); // Tel uitgaven op
            }
        }

        // Bereken het huidige saldo
        $balance = $totalIncome - $totalExpense;

        // Stuur alle gegevens naar de Twig template
        return $this->render('report/index.html.twig', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
        ]);
    }
}
