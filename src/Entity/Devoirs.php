<?php

namespace App\Entity;

use App\Repository\DevoirsRepository;
use App\Entity\Cours;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DevoirsRepository::class)]
class Devoirs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $devoir_id = null;

    #[ORM\Column(length: 32)]
    #[Assert\NotBlank(message: 'Veuillez saisir un nom de cours')]
    #[Assert\Length(
                        min: 3,
                        minMessage: 'Le nom du devoir doit contenir au moins {{ limit }} caractères',
                        max: 32,
                        maxMessage: 'Le nom du devoir doit contenir au plus {{ limit }} caractères',
    )]
    #[Assert\Regex(
                        pattern: '/^[a-zA-Z0-9][a-zA-Z0-9 -]*[a-zA-Z0-9]?$/',
                        message: 'Le nom du devoir ne doit contenir que des lettres, des chiffres, des espaces ou des tirets',        
    )]  

    private ?string $devoir_nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Regex(
                        pattern: '/^[a-zA-Z0-9][a-zA-Z0-9 -\'"]*[a-zA-Z0-9]?$/',
                        message: 'La description du devoir ne doit contenir que des lettres, des chiffres, des espaces, des tirets, des \' ou des "',        
    )]

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

    // Ligne pour test
    // private ?string $slug = null;

    // public function getSlug(): ?string
    // {
    //     return $this->slug;
    // }

    // public function setSlug(?string $nom): static
    // {
    //     $this->slug = strtolower(str_replace(' ', '-',$nom));
    //     return $this;
    // }

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
