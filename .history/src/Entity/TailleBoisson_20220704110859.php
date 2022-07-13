<?php

namespace App\Entity;

use App\Entity\Complement;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TailleBoissonRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TailleBoissonRepository::class)]
#[ApiResource]
class TailleBoisson extends Produit
{
    #[ORM\Column(type: 'string', length: 255)]
    private $pm;

    #[ORM\Column(type: 'string', length: 255)]
    private $gm;


    public function getPm(): ?string
    {
        return $this->pm;
    }

    public function setPm(string $pm): self
    {
        $this->pm = $pm;

        return $this;
    }

    public function getGm(): ?string
    {
        return $this->gm;
    }

    public function setGm(string $gm): self
    {
        $this->gm = $gm;

        return $this;
    }

}
