<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use App\Entity\Matieres;
use App\Entity\Devoirs;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $cours_id = null;

    #[ORM\Column(length: 255)]
    private ?string $cours_nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $cours_desc = null;

    public function getCoursId(): ?int
    {
        return $this->cours_id;
    }

    public function getCoursNom(): ?string
    {
        return $this->cours_nom;
    }

    public function setCoursNom(string $cours_nom): static
    {
        $this->cours_nom = $cours_nom;

        return $this;
    }

    public function getCoursDesc(): ?string
    {
        return $this->cours_desc;
    }

    public function setCoursDesc(?string $cours_desc): static
    {
        $this->cours_desc = $cours_desc;

        return $this;
    }

    // Relation ManyToOne avec Matieres
    #[ORM\ManyToOne(targetEntity: Matieres::class, inversedBy: 'cours')]
    #[ORM\JoinColumn(name: "matiere_id", referencedColumnName: "matiere_id", nullable: false)]

    private ?Matieres $matiere = null;

    public function getMatiere(): ?Matieres
        {
            return $this->matiere;
        }

    public function setMatiere(?Matieres $matiere): self
        {
            $this->matiere = $matiere;
            return $this;
        }

    // Relation OneToMany avec Devoirs
    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: Devoirs::class, cascade: ["persist"])]
    private Collection $devoirs;

    public function __construct()
    {
        $this->devoirs = new ArrayCollection();
    }
            
    public function getDevoirs(): Collection
        {
            return $this->devoirs;
        }

    public function addDevoir(Devoirs $devoir): self
        {
            if ( !$this->devoirs->contains($devoir)) {
                $this->devoirs->add($devoir);
                $devoir->setCour($this);
            }
            return $this;
        }

    public function removeDevoir(Devoirs $devoir): self
        {
            if ( $this->devoirs->removeElement($devoir)) {
                if ($devoir->getCour() === $this) {
                    $devoir->setCour(null);
                }
            }
            return $this;
        }
}
