<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ComplementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComplementRepository::class)]
#[ApiResource]
class Complement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nature;

    #[ORM\ManyToOne(targetEntity: PortionFrites::class, inversedBy: 'complement')]
    private $portionFrites;

    #[ORM\ManyToOne(targetEntity: TailleBoisson::class, inversedBy: 'complement')]
    private $tailleBoissons;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getPortionFrites(): ?PortionFrites
    {
        return $this->portionFrites;
    }

    public function setPortionFrites(?PortionFrites $portionFrites): self
    {
        $this->portionFrites = $portionFrites;

        return $this;
    }

    public function getTailleBoissons(): ?TailleBoisson
    {
        return $this->tailleBoissons;
    }

    public function setTailleBoissons(?TailleBoisson $tailleBoissons): self
    {
        $this->tailleBoissons = $tailleBoissons;

        return $this;
    }
}
