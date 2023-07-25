<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column]
    private ?int $km = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    private ?User $utilisateur = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    function __toString() {
        return $this->marque . ' ' . $this->modele;
    }


    public function getId(): ?int {
        return $this->id;
    }

    public function getMarque(): ?string {
        return $this->marque;
    }

    public function setMarque(string $marque): static {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string {
        return $this->modele;
    }

    public function setModele(string $modele): static {
        $this->modele = $modele;

        return $this;
    }

    public function getKm(): ?int {
        return $this->km;
    }

    public function setKm(int $km): static {
        $this->km = $km;

        return $this;
    }

    public function getUtilisateur(): ?User {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): static {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getImage(): ?string {
        return $this->image;
    }

    public function setImage(?string $image): static {
        $this->image = $image;

        return $this;
    }
}
