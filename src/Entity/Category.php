<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

// Dit is de Category entity.
// Een categorie die een gebruiker kan hebben, bijvoorbeeld "Eten", "Entertainment" of "Salaris".
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table(name: "categories")]
class Category
{
    // Primaire sleutel (ID) van deze categorie, automatisch gegenereerd
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Gebruiker ID: welke gebruiker deze categorie bezit
    #[ORM\Column]
    private ?int $user_id = null;

    // Naam van de categorie, bijvoorbeeld "Eten" of "Transport"
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // Type categorie: "income" (inkomen) of "expense" (uitgave)
    #[ORM\Column(length: 255)]
    private ?string $type = null;

    // Datum en tijd van creatie van deze categorie
    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    // ⚡ Constructor: zorgt dat created_at automatisch wordt ingesteld bij het aanmaken
    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    // --- GETTERS & SETTERS ---

    // Haal de ID op van deze categorie
    public function getId(): ?int
    {
        return $this->id;
    }

    // Haal de gebruiker ID op
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    // Stel de gebruiker ID in
    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;
        return $this;
    }

    // Haal de naam van de categorie op
    public function getName(): ?string
    {
        return $this->name;
    }

    // Stel de naam van de categorie in
    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    // Haal het type van de categorie op
    public function getType(): ?string
    {
        return $this->type;
    }

    // Stel het type van de categorie in
    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    // Haal de creatie datum op
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    // Stel de creatie datum in (handig bij bewerkingen)
    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;
        return $this;
    }
}
