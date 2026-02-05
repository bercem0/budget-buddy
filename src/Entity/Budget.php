<?php

namespace App\Entity;

use App\Repository\BudgetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

// 🏦 Dit is de Budget entity. Het vertegenwoordigt het budget van een gebruiker.
#[ORM\Entity(repositoryClass: BudgetRepository::class)]
#[ORM\Table(name: "budgets")]
class Budget
{
    // Primaire sleutel (ID) die automatisch omhoog telt
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Welke gebruiker dit budget heeft (ManyToOne-relatie)
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    // De categorie van dit budget (bijv. Voeding, Entertainment)
    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    // Het bedrag van het budget (decimal, max 10 cijfers, 2 decimalen)
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $amount = null;

    // Als dit een sub-budget is, kun je een parentBudget instellen
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'budgets')]
    private ?self $parentBudget = null;

    // --- GETTERS & SETTERS ---

    // Geeft de ID terug
    public function getId(): ?int
    {
        return $this->id;
    }

    // Geeft de gebruiker terug
    public function getUser(): ?User
    {
        return $this->user;
    }

    // Stelt de gebruiker in
    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }

    // Geeft de categorie terug
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    // Stelt de categorie in
    public function setCategory(?Category $category): static
    {
        $this->category = $category;
        return $this;
    }

    // Geeft het bedrag terug
    public function getAmount(): ?string
    {
        return $this->amount;
    }

    // Stelt het bedrag in
    public function setAmount(string $amount): static
    {
        $this->amount = $amount;
        return $this;
    }

    // Geeft het parent-budget terug (als dit een sub-budget is)
    public function getParentBudget(): ?self
    {
        return $this->parentBudget;
    }

    // Stelt het parent-budget in
    public function setParentBudget(?self $parentBudget): static
    {
        $this->parentBudget = $parentBudget;
        return $this;
    }
}
