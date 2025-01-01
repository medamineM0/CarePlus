<?php

namespace App\Entity;

use App\Repository\EffectueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EffectueRepository::class)]
class Effectue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $resultat = null;

    #[ORM\ManyToOne(inversedBy: 'effectues')]
    private ?Consultation $Consultation = null;

    #[ORM\ManyToOne(inversedBy: 'effectues')]
    private ?ExamClinique $Examen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): static
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getIdConsultation(): ?Consultation
    {
        return $this->Consultation;
    }

    public function setIdConsultation(?Consultation $idConsultation): static
    {
        $this->Consultation = $idConsultation;

        return $this;
    }

    public function getIdExamen(): ?ExamClinique
    {
        return $this->Examen;
    }

    public function setIdExamen(?ExamClinique $idExamen): static
    {
        $this->Examen = $idExamen;

        return $this;
    }
}
