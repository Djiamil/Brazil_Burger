<?php

namespace App\Entity;

use App\Entity\Complement;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PortionFritesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PortionFritesRepository::class)]
#[ApiResource]
class PortionFrites extends Complement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
