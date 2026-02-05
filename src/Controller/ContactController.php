<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    // Pagina om het contactformulier te laten zien en invullen
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Maak een nieuw Contact object aan
        $contact = new Contact();

        // Maak een formulier voor contact
        $form = $this->createForm(ContactType::class, $contact);

        // Kijk of de gebruiker iets heeft ingevuld in het formulier
        $form->handleRequest($request);

        // Als het formulier is ingediend en geldig is
        if ($form->isSubmitted() && $form->isValid()) {
            // Zet de huidige datum en tijd als aanmaakdatum
            $contact->setCreatedAt(new \DateTimeImmutable());

            // Sla het contact op in de database
            $entityManager->persist($contact);
            $entityManager->flush();

            // Ga naar de success-pagina na het opslaan
            return $this->redirectToRoute('contact_success');
        }

        // Laat het formulier zien als het nog niet is ingevuld
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Pagina die laat zien dat het contactformulier succesvol is verstuurd
    #[Route('/contact/success', name: 'contact_success')]
    public function success(): Response
    {
        // Render de success-pagina
        return $this->render('contact/success.html.twig');
    }

    // Pagina om alle berichten uit het contactformulier te bekijken
    #[Route('/contact/messages', name: 'contact_messages')]
    public function messages(ContactRepository $contactRepository): Response
    {
        // Haal alle berichten op uit de database, gesorteerd van nieuw naar oud
        $messages = $contactRepository->findBy([], ['createdAt' => 'DESC']);

        // Laat de berichten zien in de pagina
        return $this->render('contact/messages.html.twig', [
            'messages' => $messages,
        ]);
    }
}
