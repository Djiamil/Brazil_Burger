<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuFriteRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuFriteRepository::class)]
class MenuFrite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Groups('menu:read')]
    private $quantity;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuFrites')]
    private $menu;

    #[ORM\ManyToOne(targetEntity: Frite::class, inversedBy: 'menuFrites')]
    #[Groups('menu:read')]

    private $frite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getFrite(): ?Frite
    {
        return $this->frite;
    }

    public function setFrite(?Frite $frite): self
    {
        $this->frite = $frite;

        return $this;
    }
}
