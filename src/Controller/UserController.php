<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    // Pagina om een nieuwe gebruiker te registreren
    #[Route('/user/register', name: 'user_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        // Maak een nieuw User-object
        $user = new User();

        // Maak een formulier voor registratie
        $form = $this->createForm(UserType::class, $user);

        // Vul het formulier met de gegevens van $request
        $form->handleRequest($request);

        // Als het formulier is ingediend en geldig
        if ($form->isSubmitted() && $form->isValid()) {
            // Stel de aanmaakdatum in
            $user->setCreatedAt(new \DateTimeImmutable());

            // Bereid de gegevens voor om op te slaan
            $entityManager->persist($user);

            // Schrijf de gegevens naar de database
            $entityManager->flush();

            // Sla het user_id op in de sessie
            $session->set('user_id', $user->getId());

            // Toon een succesbericht
            $this->addFlash('success', 'User registered successfully!');

            // Stuur door naar het dashboard
            return $this->redirectToRoute('dashboard');
        }

        // Toon het registratieformulier als het nog niet is ingediend
        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Pagina om het profiel van de ingelogde gebruiker te tonen
    #[Route('/profile', name: 'profile')]
    public function profile(SessionInterface $session, UserRepository $userRepository): Response
    {
        // Haal de user_id uit de sessie
        $userId = $session->get('user_id');

        // Als er geen user_id is, stuur naar de registratiepagina
        if (!$userId) {
            return $this->redirectToRoute('user_register');
        }

        // Haal de gebruiker op uit de database
        $user = $userRepository->find($userId);

        // Als de gebruiker niet bestaat, toon een foutmelding
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        // Toon het profiel in Twig
        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
