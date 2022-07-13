<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CatalogueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatalogueRepository::class)]
#[ApiResource]
class Catalogue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Burger::class, inversedBy: 'catalogue')]
    private $burgers;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'catalogue')]
    private $menus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBurgers(): ?Burger
    {
        return $this->burgers;
    }

    public function setBurgers(?Burger $burgers): self
    {
        $this->burgers = $burgers;

        return $this;
    }

    public function getMenus(): ?Menu
    {
        return $this->menus;
    }

    public function setMenus(?Menu $menus): self
    {
        $this->menus = $menus;

        return $this;
    }
}
