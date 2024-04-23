<?php

namespace App\Entity;

use App\Repository\HoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoursRepository::class)]
class Hours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $jours = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $openHours = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $closeHours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJours(): ?string
    {
        return $this->jours;
    }

    public function setJours(string $jours): static
    {
        $this->jours = $jours;

        return $this;
    }

    public function getOpenHours(): ?\DateTimeInterface
    {
        return $this->openHours;
    }

    public function setOpenHours(?\DateTimeInterface $openHours): static
    {
        $this->openHours = $openHours;

        return $this;
    }

    public function getCloseHours(): ?\DateTimeInterface
    {
        return $this->closeHours;
    }

    public function setCloseHours(?\DateTimeInterface $closeHours): static
    {
        $this->closeHours = $closeHours;

        return $this;
    }
}
