<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['produit'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['produit'])]
    private ?string $image = null;

    #[ORM\Column(length: 1500)]
    #[Groups(['produit'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['produit'])]
    private ?string $titre = null;

    #[ORM\Column]
    #[Groups(['produit'])]
    private ?float $prix = null;

    #[ORM\Column]
    #[Groups(['produit'])]
    private ?bool $personnalisation = null;

    #[ORM\ManyToMany(targetEntity: Personnalisation::class, inversedBy: 'produits')]
    #[Groups(['produit'])]
    private Collection $namePersonnalisation;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[Groups(['produit'])]
    private ?Categorie $Categories = null;

    #[ORM\OneToMany(mappedBy: 'produitAvis', targetEntity: Avis::class)]
    #[Groups(['produit'])]
    private Collection $avis;

    #[ORM\Column]
    #[Groups(['produit'])]
    private ?bool $homePage = null;

    #[ORM\Column(length: 255)]
    #[Groups(['produit'])]
    private ?string $slug = null;

    public function __construct()
    {
        $this->namePersonnalisation = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function isPersonnalisation(): ?bool
    {
        return $this->personnalisation;
    }

    public function setPersonnalisation(bool $personnalisation): static
    {
        $this->personnalisation = $personnalisation;

        return $this;
    }

    /**
     * @return Collection<int, Personnalisation>
     */
    public function getNamePersonnalisation(): Collection
    {
        return $this->namePersonnalisation;
    }

    public function addNamePersonnalisation(Personnalisation $namePersonnalisation): static
    {
        if (!$this->namePersonnalisation->contains($namePersonnalisation)) {
            $this->namePersonnalisation->add($namePersonnalisation);
        }

        return $this;
    }

    public function removeNamePersonnalisation(Personnalisation $namePersonnalisation): static
    {
        $this->namePersonnalisation->removeElement($namePersonnalisation);

        return $this;
    }

    public function getCategories(): ?Categorie
    {
        return $this->Categories;
    }

    public function setCategories(?Categorie $Categories): static
    {
        $this->Categories = $Categories;

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setProduitAvis($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getProduitAvis() === $this) {
                $avi->setProduitAvis(null);
            }
        }

        return $this;
    }

    public function isHomePage(): ?bool
    {
        return $this->homePage;
    }

    public function setHomePage(bool $homePage): static
    {
        $this->homePage = $homePage;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

}
