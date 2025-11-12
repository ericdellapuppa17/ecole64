<?php

namespace App\Entity;

use App\Repository\MatieresRepository;
use App\Entity\Formations;
use App\Entity\Professeurs;
use App\Entity\Cours;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatieresRepository::class)]
#[ORM\Table(name: "matieres")]
class Matieres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column("matiere_id", type: "integer")]
    private ?int $matiere_id = null;

    #[ORM\Column(length: 255)]
    private ?string $matiere_nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $matiere_desc = null;

    public function getMatiereId(): ?int
    {
        return $this->matiere_id;
    }

    public function getMatiereNom(): ?string
    {
        return $this->matiere_nom;
    }

    public function setMatiereNom(string $matiere_nom): static
    {
        $this->matiere_nom = $matiere_nom;

        return $this;
    }

    public function getMatiereDesc(): ?string
    {
        return $this->matiere_desc;
    }

    public function setMatiereDesc(?string $matiere_desc): static
    {
        $this->matiere_desc = $matiere_desc;

        return $this;
    }

    // Relation ManyToMany avec Formations
    #[ORM\ManyToMany(targetEntity: Formations::class, mappedBy: 'matieres')]
    private Collection $formations;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->professeurs = new ArrayCollection();
        $this->cours = new ArrayCollection();
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formations $formation): static
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
        }

        return $this;
    }

    public function removeFormation(Formations $formation): static
    {
        $this->formations->removeElement($formation);

        return $this;
    }

    // Relation ManyToMany avec Professeurs
    #[ORM\ManyToMany(targetEntity: Professeurs::class, mappedBy: "matieres")]
    private Collection $professeurs;

    /**
     * @return Collection|Professeurs[]
     */

    public function getProfesseur(): Collection
        {
            return $this->professeurs;
        }

    public function addProfesseur(Professeurs $professeur): static
        {
            if ( !$this->professeurs->contains($professeur)) {
                $this->professeurs[] = $professeur;
            }
            return $this;
        }

    public function removeProfesseur(Professeurs $professeur): static
        {
            $this->professeurs->removeElement($professeur);
            return $this;
        }

    // Relation OneToMany avec Cours
    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: Cours::class, cascade: ["persist"])]
    private Collection $cours;
            
    public function getCours(): Collection
        {
            return $this->cours;
        }

    public function addCour(Cours $cour): self
        {
            if ( !$this->cours->contains($cour)) {
                $this->cours->add($cour);
                $cour->setMatiere($this);
            }
            return $this;
        }

    public function removeCour(Cours $cour): self
        {
            if ( $this->cours->removeElement($cour)) {
                if ($cour->getMatiere() === $this) {
                    $cour->setMatiere(null);
                }
            }
            return $this;
        }

}
