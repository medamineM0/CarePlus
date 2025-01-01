<?php

namespace App\Entity;

use App\Repository\TraitementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraitementRepository::class)]
class Traitement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $NomTraitement = null;

    /**
     * @var Collection<int, Prescrire>
     */
    #[ORM\OneToMany(targetEntity: Prescrire::class, mappedBy: 'Traitement')]
    private Collection $prescrires;

    public function __construct()
    {
        $this->prescrires = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTraitement(): ?string
    {
        return $this->NomTraitement;
    }

    public function setNomTraitement(string $NomTraitement): static
    {
        $this->NomTraitement = $NomTraitement;

        return $this;
    }

    /**
     * @return Collection<int, Prescrire>
     */
    public function getPrescrires(): Collection
    {
        return $this->prescrires;
    }

    public function addPrescrire(Prescrire $prescrire): static
    {
        if (!$this->prescrires->contains($prescrire)) {
            $this->prescrires->add($prescrire);
            $prescrire->setIdTraitement($this);
        }

        return $this;
    }

    public function removePrescrire(Prescrire $prescrire): static
    {
        if ($this->prescrires->removeElement($prescrire)) {
            // set the owning side to null (unless already changed)
            if ($prescrire->getIdTraitement() === $this) {
                $prescrire->setIdTraitement(null);
            }
        }

        return $this;
    }
}
