<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FriteRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: FriteRepository::class)]
#[ApiResource]
class Frite extends Produit
{
    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'frites')]
    private $menus;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->addFrite($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeFrite($this);
        }

        return $this;
    }
}
