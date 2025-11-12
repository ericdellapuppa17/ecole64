<?php

namespace App\Entity;

use App\Repository\ProfesseursRepository;
use App\Entity\Matieres;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity(repositoryClass: ProfesseursRepository::class)]
#[ORM\Table(name: "professeurs")]
class Professeurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "professeur_id", type: "integer")]

    private ?int $professeur_id = null;

    #[ORM\Column(length: 255)]
    private ?string $professeur_nom = null;

    #[ORM\Column(length: 255)]
    private ?string $professeur_prenom = null;

    public function getProfesseurId(): ?int
    {
        return $this->professeur_id;
    }

    public function getProfesseurNom(): ?string
    {
        return $this->professeur_nom;
    }

    public function setProfesseurNom(string $professeur_nom): static
    {
        $this->professeur_nom = $professeur_nom;

        return $this;
    }

    public function getProfesseurPrenom(): ?string
    {
        return $this->professeur_prenom;
    }

    public function setProfesseurPrenom(string $professeur_prenom): static
    {
        $this->professeur_prenom = $professeur_prenom;

        return $this;
    }

    // Relation ManyToMany avec Matieres
    #[ORM\ManyToMany(targetEntity: Matieres::class, inversedBy: "professeurs", cascade: ["persist"])]
    #[ORM\JoinTable( name: "professeurs_matieres",
        joinColumns: [new ORM\JoinColumn(name: "professeur_id", referencedColumnName: "professeur_id")],
        inverseJoinColumns: [new ORM\JoinColumn(name: "matiere_id", referencedColumnName: "matiere_id")]
    )]

    private Collection $matieres;

    public function __construct()
        {
            $this->matieres = new ArrayCollection();
        }

    /**
     * @return Collection|Matieres[]
     */

    public function getMatieres(): Collection
        {
            return $this->matieres;
        }

    public function addMatiere(Matieres $matiere): static
        {
            if ( !$this->matieres->contains($matiere)) {
                $this->matieres[] = $matiere;
                $matiere->addProfesseur($this);
            }
            return $this;
        }

    public function removeMatiere(Matieres $matiere): static  
        {
            if ( $this->matieres->removeElement($matiere)) {
                $matiere->removeProfesseur($this);
            }
            return $this;
        }
}
