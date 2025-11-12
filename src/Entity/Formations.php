<?php

namespace App\Entity;

use App\Repository\FormationsRepository;
use App\Entity\Matieres;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]
#[ORM\Table(name: "formations")]
class Formations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "frm_id", type: "integer")]
    private ?int $frm_id = null;

    #[ORM\Column(length: 255)]
    private ?string $frm_nom = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $frm_desc = null;

    public function getFrmId(): ?int
    {
        return $this->frm_id;
    }

    public function getFrmNom(): ?string
    {
        return $this->frm_nom;
    }

    public function setFrmNom(string $frm_nom): static
    {
        $this->frm_nom = $frm_nom;

        return $this;
    }

    public function getFrmDesc(): ?string
    {
        return $this->frm_desc;
    }

    public function setFrmDesc(?string $frm_desc): static
    {
        $this->frm_desc = $frm_desc;

        return $this;
    }

    // relation ManyToMany avec Matieres
    #[ORM\ManyToMany(targetEntity: Matieres::class, inversedBy: "formations", cascade: ["persist"])]
    #[ORM\JoinTable(name: "formations_matieres",
        joinColumns: [new ORM\JoinColumn(name: "formation_id", referencedColumnName: "frm_id")],
        inverseJoinColumns: [new ORM\JoinColumn(name: "matiere_id", referencedColumnName: "matiere_id")]
    )] // table pivot

    private Collection $matieres;

    public function __construct()
        {
            $this->matieres = new ArrayCollection();
        }
    
    public function getMatieres() : Collection
        {
            return $this->matieres;
        }

    public function addMatiere(Matieres $matiere) : static
        {
            if ( !$this->matieres->contains($matiere) ) {
                $this->matieres[] = $matiere;
                $matiere->addFormation($this);
            }
            return $this;
        }

    public function removeMatiere(Matieres $matiere) : static
        {
            if ( $this->matieres->removeElement($matiere)) {
                $matiere->removeFormation($this);
            }
            return $this;
        }
}
