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


    #[ORM\OneToMany(mappedBy: 'frite', targetEntity: MenuFrite::class)]
    private $menuFrites;

    public function __construct()
    {
        $this->menuFrites = new ArrayCollection();
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }


    /**
     * @return Collection<int, MenuFrite>
     */
    public function getMenuFrites(): Collection
    {
        return $this->menuFrites;
    }

    public function addMenuFrite(MenuFrite $menuFrite): self
    {
        if (!$this->menuFrites->contains($menuFrite)) {
            $this->menuFrites[] = $menuFrite;
            $menuFrite->setFrite($this);
        }

        return $this;
    }

    public function removeMenuFrite(MenuFrite $menuFrite): self
    {
        if ($this->menuFrites->removeElement($menuFrite)) {
            // set the owning side to null (unless already changed)
            if ($menuFrite->getFrite() === $this) {
                $menuFrite->setFrite(null);
            }
        }

        return $this;
    }
}
