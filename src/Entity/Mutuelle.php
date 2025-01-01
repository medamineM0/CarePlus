<?php

namespace App\Entity;

use App\Repository\MutuelleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MutuelleRepository::class)]
class Mutuelle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $TitreMutuelle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreMutuelle(): ?string
    {
        return $this->TitreMutuelle;
    }

    public function setTitreMutuelle(string $TitreMutuelle): static
    {
        $this->TitreMutuelle = $TitreMutuelle;

        return $this;
    }
}
