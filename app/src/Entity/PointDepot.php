<?php

namespace App\Entity;

use App\Repository\PointDepotRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PointDepotRepository::class)]
class PointDepot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 20)]
    private ?string $categorie = null;

    #[ORM\Column]
    private ?int $capaciteMax = null;

    #[ORM\Column(type: Types::JSON)]
    private ?array $joursLivraison = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $creneauxRecuperation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCapaciteMax(): ?int
    {
        return $this->capaciteMax;
    }

    public function setCapaciteMax(int $capaciteMax): static
    {
        $this->capaciteMax = $capaciteMax;

        return $this;
    }

    public function getJoursLivraison(): ?array
    {
        return $this->joursLivraison;
    }

    public function setJoursLivraison(array $joursLivraison): static
    {
        $this->joursLivraison = $joursLivraison;

        return $this;
    }

    public function getCreneauxRecuperation(): ?string
    {
        return $this->creneauxRecuperation;
    }

    public function setCreneauxRecuperation(?string $creneauxRecuperation): static
    {
        $this->creneauxRecuperation = $creneauxRecuperation;

        return $this;
    }
}
