<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Klasse Transaction
 * -------------------
 * Dit is een entiteit die een financiële transactie vertegenwoordigt in de applicatie.
 * Elke transactie wordt opgeslagen in de 'transactions' tabel in de database.
 */
#[ORM\Entity(repositoryClass: TransactionRepository::class)]
#[ORM\Table(name: "transactions")]
class Transaction
{
    // Uniek ID van de transactie (primaire sleutel, automatisch gegenereerd)
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // De gebruiker die deze transactie heeft uitgevoerd
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    // De categorie waartoe deze transactie behoort (bijv. eten, huur, salaris)
    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    // Het budget waaraan deze transactie gekoppeld is
    #[ORM\ManyToOne(targetEntity: Budget::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Budget $budget = null;

    // Het bedrag van de transactie (string, kan decimals bevatten)
    #[ORM\Column(length: 255)]
    private ?string $amount = null;

    // De datum waarop de transactie heeft plaatsgevonden
    #[ORM\Column]
    private ?\DateTimeImmutable $date = null;

    // Eventuele notities of beschrijving van de transactie
    #[ORM\Column(type: Types::TEXT)]
    private ?string $note = null;

    // Datum en tijd waarop deze transactie is aangemaakt in het systeem
    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    // Het type van transactie: bijvoorbeeld 'income' of 'expense'
    #[ORM\Column(length: 255)]
    private ?string $type = null;

    // Constructor: zorgt dat created_at automatisch wordt ingesteld bij nieuwe transacties
    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }


    // Getter en Setter methoden

    // Haalt het ID van de transactie op
    public function getId(): ?int
    {
        return $this->id;
    }

    // Haalt de gebruiker van de transactie op
    public function getUser(): ?User
    {
        return $this->user;
    }

    // Stelt de gebruiker van de transactie in
    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }

    // Haalt de categorie van de transactie op
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    // Stelt de categorie van de transactie in
    public function setCategory(?Category $category): static
    {
        $this->category = $category;
        return $this;
    }

    // Haalt het budget van de transactie op
    public function getBudget(): ?Budget
    {
        return $this->budget;
    }

    // Stelt het budget van de transactie in
    public function setBudget(?Budget $budget): static
    {
        $this->budget = $budget;
        return $this;
    }

    // Haalt het bedrag van de transactie op
    public function getAmount(): ?string
    {
        return $this->amount;
    }

    // Stelt het bedrag van de transactie in
    public function setAmount(string $amount): static
    {
        $this->amount = $amount;
        return $this;
    }

    // Haalt de datum van de transactie op
    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    // Stelt de datum van de transactie in
    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;
        return $this;
    }

    // Haalt de notitie van de transactie op
    public function getNote(): ?string
    {
        return $this->note;
    }

    // Stelt de notitie van de transactie in
    public function setNote(string $note): static
    {
        $this->note = $note;
        return $this;
    }

    // Haalt de aanmaakdatum van de transactie op
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    // Stelt de aanmaakdatum van de transactie in
    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;
        return $this;
    }

    // Haalt het type van de transactie op
    public function getType(): ?string
    {
        return $this->type;
    }

    // Stelt het type van de transactie in
    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }
}
