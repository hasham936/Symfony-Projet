<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email()]
    #[Assert\NotBlank()]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $sujet = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 10)]
    private ?string $message = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $dateEnvoi = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $estLu = false;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $auteur = null;

    public function __construct()
    {
        $this->dateEnvoi = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeImmutable
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(\DateTimeImmutable $dateEnvoi): self
    {
        $this->dateEnvoi = $dateEnvoi;
        return $this;
    }

    public function isEstLu(): bool
    {
        return $this->estLu;
    }

    public function setEstLu(bool $estLu): self
    {
        $this->estLu = $estLu;
        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;
        return $this;
    }
}
