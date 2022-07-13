<?php

namespace App\Entity;
use App\Entity\Complement;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PortionFritesRepository;
use ApiPlatform\Core\Annotation\ApiResource;


#[ORM\Entity(repositoryClass: PortionFritesRepository::class)]
#[ApiResource]
class PortionFrites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

}
