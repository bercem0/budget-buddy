<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Klasse User
 * -------------------
 * Dit is een entiteit die een gebruiker van de applicatie vertegenwoordigt.
 * Elke gebruiker wordt opgeslagen in de 'users' tabel in de database.
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: "users")]
class User
{
    // Uniek ID van de gebruiker (primaire sleutel, automatisch gegenereerd)
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Naam van de gebruiker
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // E-mailadres van de gebruiker
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    // Datum en tijd waarop de gebruiker is aangemaakt
    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;


    // Getter en Setter methoden

    // Haalt het ID van de gebruiker op
    public function getId(): ?int
    {
        return $this->id;
    }

    // Haalt de naam van de gebruiker op
    public function getName(): ?string
    {
        return $this->name;
    }

    // Stelt de naam van de gebruiker in
    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    // Haalt het e-mailadres van de gebruiker op
    public function getEmail(): ?string
    {
        return $this->email;
    }

    // Stelt het e-mailadres van de gebruiker in
    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    // Haalt de aanmaakdatum van de gebruiker op
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    //Stelt de aanmaakdatum van de gebruiker in
    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;
        return $this;
    }
}
