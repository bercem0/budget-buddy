<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use App\Repository\TransactionRepository;
use App\Repository\BudgetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    // Pagina om algemene dashboard statistieken te zien
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        UserRepository        $userRepository,
        CategoryRepository    $categoryRepository,
        TransactionRepository $transactionRepository,
        BudgetRepository      $budgetRepository
    ): Response
    {
        // Tel het aantal gebruikers, categorieën, transacties en budgetten
        $users = $userRepository->count([]);
        $categories = $categoryRepository->count([]);
        $transactions = $transactionRepository->count([]);
        $budgets = $budgetRepository->count([]);

        // Bereken het totaal van inkomsten
        $income = $transactionRepository->createQueryBuilder('t')
            ->select('SUM(t.amount)')
            ->where('t.type = :type')
            ->setParameter('type', 'income')
            ->getQuery()
            ->getSingleScalarResult() ?? 0;

        // Bereken het totaal van uitgaven
        $expense = $transactionRepository->createQueryBuilder('t')
            ->select('SUM(t.amount)')
            ->where('t.type = :type')
            ->setParameter('type', 'expense')
            ->getQuery()
            ->getSingleScalarResult() ?? 0;

        // Haal de 4 meest recente uitgaven op
        $recentExpenses = $transactionRepository->createQueryBuilder('t')
            ->where('t.type = :type')
            ->setParameter('type', 'expense')
            ->orderBy('t.date', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();

        // Stuur alle gegevens naar de Twig template
        return $this->render('dashboard/index.html.twig', [
            'users' => $users,
            'categories' => $categories,
            'transactions' => $transactions,
            'budgets' => $budgets,
            'income' => $income,
            'expense' => $expense,
            'recentExpenses' => $recentExpenses,
        ]);
    }

    // Pagina voor ingelogde gebruikers dashboard
    #[Route('/dashboard-user', name: 'dashboard')]
    public function dashboard(
        SessionInterface      $session, // $session = gebruikerssessie, bv. user_id opslaan en ophalen
        UserRepository        $userRepository,
        CategoryRepository    $categoryRepository,
        TransactionRepository $transactionRepository,
        BudgetRepository      $budgetRepository
    ): Response
    {
        // Haal de user_id uit de sessie
        $userId = $session->get('user_id'); // $session->get = sessiegegevens ophalen

        // Als de gebruiker niet is ingelogd, stuur door naar registratiepagina
        if (!$userId) {
            return $this->redirectToRoute('user_register');
        }

        // Haal de gebruiker op uit de database
        $user = $userRepository->find($userId);

        // Tel het aantal gebruikers, categorieën, transacties en budgetten (voor Twig)
        $users = $userRepository->count([]);
        $categories = $categoryRepository->count([]);
        $transactions = $transactionRepository->count([]);
        $budgets = $budgetRepository->count([]);

        // Bereken het totaal van inkomsten
        $income = $transactionRepository->createQueryBuilder('t')
            ->select('SUM(t.amount)')
            ->where('t.type = :type')
            ->setParameter('type', 'income')
            ->getQuery()
            ->getSingleScalarResult() ?? 0;

        // Bereken het totaal van uitgaven
        $expense = $transactionRepository->createQueryBuilder('t')
            ->select('SUM(t.amount)')
            ->where('t.type = :type')
            ->setParameter('type', 'expense')
            ->getQuery()
            ->getSingleScalarResult() ?? 0;

        // Haal de 4 meest recente uitgaven op
        $recentExpenses = $transactionRepository->createQueryBuilder('t')
            ->where('t.type = :type')
            ->setParameter('type', 'expense')
            ->orderBy('t.date', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();

        // Stuur alle gegevens naar de Twig template
        return $this->render('dashboard/index.html.twig', [
            'user' => $user,
            'users' => $users,
            'categories' => $categories,
            'transactions' => $transactions,
            'budgets' => $budgets,
            'income' => $income,
            'expense' => $expense,
            'recentExpenses' => $recentExpenses,
        ]);
    }
}
