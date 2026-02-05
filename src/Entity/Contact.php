<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

// Deze klasse vertegenwoordigt een "Contact" entiteit in de database.
// Het wordt gebruikt om contactformulieren of berichten van gebruikers op te slaan.
#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    // Uniek ID van het bericht (primaire sleutel, automatisch gegenereerd)
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Naam van de persoon die het bericht stuurt
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // E-mailadres van de persoon die het bericht stuurt
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    // Onderwerp van het bericht
    #[ORM\Column(length: 255)]
    private ?string $subject = null;

    // Inhoud van het bericht (lange tekst)
    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    // Datum en tijd waarop het bericht is aangemaakt
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    // -------------------------
    // Getter en Setter methoden
    // -------------------------

    // Haalt de ID op
    public function getId(): ?int
    {
        return $this->id;
    }

    // Haalt de naam op
    public function getName(): ?string
    {
        return $this->name;
    }

    // Stelt de naam in
    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    // Haalt het e-mailadres op
    public function getEmail(): ?string
    {
        return $this->email;
    }

    // Stelt het e-mailadres in
    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    // Haalt het onderwerp op
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    // Stelt het onderwerp in
    public function setSubject(string $subject): static
    {
        $this->subject = $subject;
        return $this;
    }

    // Haalt het bericht op
    public function getMessage(): ?string
    {
        return $this->message;
    }

    // Stelt het bericht in
    public function setMessage(string $message): static
    {
        $this->message = $message;
        return $this;
    }

    // Haalt de aanmaakdatum op
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    // Stelt de aanmaakdatum in
    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
