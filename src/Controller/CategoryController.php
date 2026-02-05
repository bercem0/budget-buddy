<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    // Pagina om alle categorieën te zien
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        // Haal alle categorieën uit de database
        $categories = $categoryRepository->findAll();

        // Laat de categorieën zien in de pagina
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    // Pagina om een nieuwe categorie toe te voegen
    #[Route('/category/new', name: 'category_new')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Maak een nieuw Category object aan
        $category = new Category();

        // Maak een formulier voor de categorie
        $form = $this->createForm(CategoryType::class, $category);

        // Controleer of de gebruiker iets heeft ingevuld in het formulier
        $form->handleRequest($request);

        // Als het formulier is ingevuld en geldig is
        if ($form->isSubmitted() && $form->isValid()) {
            // Stel userId in (voorlopig 1)
            $category->setUserId(1);

            // Sla de nieuwe categorie op in de database
            $entityManager->persist($category);
            $entityManager->flush();

            // Laat een succesbericht zien
            $this->addFlash('success', 'Categorie is succesvol toegevoegd!');

            // Ga terug naar de lijst van categorieën
            return $this->redirectToRoute('app_category');
        }

        // Laat het formulier zien als het nog niet is ingevuld
        return $this->render('category/new.html.twig', [
            'form' => $form->createView(),
            'editMode' => false, // geef aan dat dit een nieuw object is
        ]);
    }

    // Pagina om een bestaande categorie te bewerken
    #[Route('/category/edit/{id}', name: 'category_edit')]
    public function edit(Category $category, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Maak een formulier voor de categorie die we willen bewerken
        $form = $this->createForm(CategoryType::class, $category);

        // Controleer of de gebruiker iets heeft ingevuld in het formulier
        $form->handleRequest($request);

        // Als het formulier is ingevuld en geldig
        if ($form->isSubmitted() && $form->isValid()) {
            // Sla de wijzigingen op in de database
            $entityManager->flush();

            // Laat een succesbericht zien
            $this->addFlash('success', 'Categorie succesvol bijgewerkt!');

            // Ga terug naar de lijst van categorieën
            return $this->redirectToRoute('app_category');
        }

        // Laat het formulier zien voor bewerken
        return $this->render('category/new.html.twig', [
            'form' => $form->createView(),
            'editMode' => true, // geef aan dat dit een bestaande categorie is
        ]);
    }

    // Verwijder een categorie uit de database
    #[Route('/category/delete/{id}', name: 'category_delete', methods: ['POST'])]
    public function delete(Category $category, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Controleer of het CSRF-token geldig is
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {
            try {
                // Verwijder de categorie
                $entityManager->remove($category);
                $entityManager->flush();

                // Laat een succesbericht zien
                $this->addFlash('success', 'Categorie succesvol verwijderd!');
            } catch (\Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException $e) {
                // Laat een foutmelding zien als de categorie nog gekoppeld is aan budgetten of transacties
                $this->addFlash('error', 'Categorie kan niet worden verwijderd omdat deze nog gekoppeld is aan budgetten of transacties.');
            }
        }

        // Ga terug naar de lijst van categorieën
        return $this->redirectToRoute('app_category');
    }
}
