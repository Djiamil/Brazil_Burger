<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreurRepository;
use ApiPlatform\Core\Annotation\ApiResource;
#[ApiResource()]

#[ORM\Entity(repositoryClass: LivreurRepository::class)]
class Livreur extends User
{

    #[ORM\Column(type: 'string', length: 255)]
    private $matMoto;

  

    public function getMatMoto(): ?string
    {
        return $this->matMoto;
    }

    public function setMatMoto(string $matMoto): self
    {
        $this->matMoto = $matMoto;

        return $this;
    }
}
