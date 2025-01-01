<?php

namespace App\Entity;

use App\Repository\PrescrireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrescrireRepository::class)]
class Prescrire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $prescription = null;

    #[ORM\ManyToOne(inversedBy: 'prescrires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Traitement $Traitement = null;
    
    #[ORM\ManyToOne(inversedBy: 'prescrires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Consultation $Consultation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrescription(): ?string
    {
        return $this->prescription;
    }

    public function setPrescription(string $prescription): static
    {
        $this->prescription = $prescription;

        return $this;
    }

    public function getIdTraitement(): ?Traitement
    {
        return $this->Traitement;
    }

    public function setIdTraitement(?Traitement $idTraitement): static
    {
        $this->Traitement = $idTraitement;

        return $this;
    }

    public function getInConsultation(): ?Consultation
    {
        return $this->Consultation;
    }

    public function setInConsultation(?Consultation $Consultation): static
    {
        $this->Consultation = $Consultation;

        return $this;
    }
}
