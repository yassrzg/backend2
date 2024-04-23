<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $note = null;

    #[ORM\Column(length: 1000)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    private ?User $userAvis = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    private ?Produit $produitAvis = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUserAvis(): ?User
    {
        return $this->userAvis;
    }

    public function setUserAvis(?User $userAvis): static
    {
        $this->userAvis = $userAvis;

        return $this;
    }

    public function getProduitAvis(): ?Produit
    {
        return $this->produitAvis;
    }

    public function setProduitAvis(?Produit $produitAvis): static
    {
        $this->produitAvis = $produitAvis;

        return $this;
    }
}
