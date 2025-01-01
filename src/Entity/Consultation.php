<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $motif = null;

    #[ORM\Column(length: 150)]
    private ?string $interrogation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateConsultation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateConsProchaine = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $Patient = null;

    #[ORM\Column(length: 15)]
    private ?string $type = null;

    #[ORM\Column(length: 100)]
    private ?string $suivi = null;

    #[ORM\Column(length: 100)]
    private ?string $diagnostique = null;

    /**
     * @var Collection<int, Prescrire>
     */
    #[ORM\OneToMany(targetEntity: Prescrire::class, mappedBy: 'Consultation')]
    private Collection $prescrires;

    /**
     * @var Collection<int, ExamClinique>
     */
    #[ORM\ManyToMany(targetEntity: ExamClinique::class, inversedBy: 'consultations')]
    private Collection $testRecommande;

    /**
     * @var Collection<int, Effectue>
     */
    #[ORM\OneToMany(targetEntity: Effectue::class, mappedBy: 'Consultation')]
    private Collection $effectues;

    public function __construct()
    {
        $this->prescrires = new ArrayCollection();
        $this->testRecommande = new ArrayCollection();
        $this->effectues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): static
    {
        $this->motif = $motif;

        return $this;
    }

    public function getInterrogation(): ?string
    {
        return $this->interrogation;
    }

    public function setInterrogation(string $interrogation): static
    {
        $this->interrogation = $interrogation;

        return $this;
    }

    public function getDateConsultation(): ?\DateTimeInterface
    {
        return $this->dateConsultation;
    }

    public function setDateConsultation(\DateTimeInterface $dateConsultation): static
    {
        $this->dateConsultation = $dateConsultation;

        return $this;
    }

    public function getDateConsProchaine(): ?\DateTimeInterface
    {
        return $this->dateConsProchaine;
    }

    public function setDateConsProchaine(\DateTimeInterface $dateConsProchaine): static
    {
        $this->dateConsProchaine = $dateConsProchaine;

        return $this;
    }

    public function getIdPatient(): ?Patient
    {
        return $this->Patient;
    }

    public function setIdPatient(?Patient $idPatient): static
    {
        $this->Patient = $idPatient;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSuivi(): ?string
    {
        return $this->suivi;
    }

    public function setSuivi(string $suivi): static
    {
        $this->suivi = $suivi;

        return $this;
    }

    public function getDiagnostique(): ?string
    {
        return $this->diagnostique;
    }

    public function setDiagnostique(string $diagnostique): static
    {
        $this->diagnostique = $diagnostique;

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
            $prescrire->setInConsultation($this);
        }

        return $this;
    }

    public function removePrescrire(Prescrire $prescrire): static
    {
        if ($this->prescrires->removeElement($prescrire)) {
            // set the owning side to null (unless already changed)
            if ($prescrire->getInConsultation() === $this) {
                $prescrire->setInConsultation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ExamClinique>
     */
    public function getTestRecommande(): Collection
    {
        return $this->testRecommande;
    }

    public function addTestRecommande(ExamClinique $testRecommande): static
    {
        if (!$this->testRecommande->contains($testRecommande)) {
            $this->testRecommande->add($testRecommande);
        }

        return $this;
    }

    public function removeTestRecommande(ExamClinique $testRecommande): static
    {
        $this->testRecommande->removeElement($testRecommande);

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
            $effectue->setIdConsultation($this);
        }

        return $this;
    }

    public function removeEffectue(Effectue $effectue): static
    {
        if ($this->effectues->removeElement($effectue)) {
            // set the owning side to null (unless already changed)
            if ($effectue->getIdConsultation() === $this) {
                $effectue->setIdConsultation(null);
            }
        }

        return $this;
    }

    
}
