<?php

namespace App\Twig\Components;
use App\Repository\PatientRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class PatientSearch
{
    use DefaultActionTrait;
    #[LiveProp(writable: true)]
    public ?string $query = '';
    #[LiveProp(writable: true)]
    public ?string $searchType='';

    public function __construct(private PatientRepository $patient)
    {
    }

    public function getPatientsByName(): array
    {
        return $this->patient->findByName($this->query);
    }
    public function getPatientsByCNI(): array
    {
        return $this->patient->findByCNI($this->query);
    }
    
    
}
