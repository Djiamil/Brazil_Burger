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
class PortionFrites extends Produit
{


    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'portionFrites')]
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
            $menu->addPortionFrite($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removePortionFrite($this);
        }

        return $this;
    }
}
