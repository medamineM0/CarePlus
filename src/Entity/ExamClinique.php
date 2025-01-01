<?php

namespace App\Entity;

use App\Repository\ExamCliniqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExamCliniqueRepository::class)]
class ExamClinique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $nomExamen = null;

    /**
     * @var Collection<int, Consultation>
     */
    #[ORM\ManyToMany(targetEntity: Consultation::class, mappedBy: 'testRecommande')]
    private Collection $consultations;

    /**
     * @var Collection<int, Effectue>
     */
    #[ORM\OneToMany(targetEntity: Effectue::class, mappedBy: 'Examen')]
    private Collection $effectues;

    public function __construct()
    {
        $this->consultations = new ArrayCollection();
        $this->effectues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomExamen(): ?string
    {
        return $this->nomExamen;
    }

    public function setNomExamen(string $nomExamen): static
    {
        $this->nomExamen = $nomExamen;

        return $this;
    }

    /**
     * @return Collection<int, Consultation>
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): static
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations->add($consultation);
            $consultation->addTestRecommande($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): static
    {
        if ($this->consultations->removeElement($consultation)) {
            $consultation->removeTestRecommande($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Effectue>
     */
    public function getEffectues(): Collection
    {
        return $this->effectues;
    }

    public function addEffectue(Effectue $effectue): static
    {
        if (!$this->effectues->contains($effectue)) {
            $this->effectues->add($effectue);
            $effectue->setIdExamen($this);
        }

        return $this;
    }

    public function removeEffectue(Effectue $effectue): static
    {
        if ($this->effectues->removeElement($effectue)) {
            // set the owning side to null (unless already changed)
            if ($effectue->getIdExamen() === $this) {
                $effectue->setIdExamen(null);
            }
        }

        return $this;
    }
}
