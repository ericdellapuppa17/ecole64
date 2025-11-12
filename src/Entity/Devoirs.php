<?php

namespace App\Entity;

use App\Repository\DevoirsRepository;
use App\Entity\Cours;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevoirsRepository::class)]
class Devoirs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $devoir_id = null;

    #[ORM\Column(length: 255)]
    private ?string $devoir_nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $devoir_desc = null;

    public function getDevoirId(): ?int
    {
        return $this->devoir_id;
    }

    public function getDevoirNom(): ?string
    {
        return $this->devoir_nom;
    }

    public function setDevoirNom(string $devoir_nom): static
    {
        $this->devoir_nom = $devoir_nom;

        return $this;
    }

    public function getDevoirDesc(): ?string
    {
        return $this->devoir_desc;
    }

    public function setDevoirDesc(?string $devoir_desc): static
    {
        $this->devoir_desc = $devoir_desc;

        return $this;
    }

    // Relation ManyToOne avec Cours
    #[ORM\ManyToOne(targetEntity: Cours::class, inversedBy: 'devoirs')]
    #[ORM\JoinColumn(name: "cours_id", referencedColumnName: "cours_id", nullable: false)]

    private ?Cours $cour = null;

    public function getCour(): ?Cours
        {
            return $this->cour;
        }

    public function setCour(?Cours $cour): self
        {
            $this->cour = $cour;
            return $this;
        }
}
