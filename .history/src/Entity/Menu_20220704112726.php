<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource()]
class Menu extends Produit
{
    #[ORM\ManyToMany(targetEntity: Burger::class, mappedBy: 'menus')]
    private $burgers;

    #[ORM\ManyToMany(targetEntity: TailleBoisson::class, inversedBy: 'menus')]
    private $tailleBoissons;

    #[ORM\ManyToMany(targetEntity: PortionFrites::class, inversedBy: 'menus')]
    private $portionFrites;

    public function __construct()
    {
        $this->burgers = new ArrayCollection();
    }

    /**
     * @return Collection<int, Burger>
     */
    public function getBurgers(): Collection
    {
        return $this->burgers;
    }

    public function addBurger(Burger $burger): self
    {
        if (!$this->burgers->contains($burger)) {
            $this->burgers[] = $burger;
            $burger->addMenu($this);
        }

        return $this;
    }

    public function removeBurger(Burger $burger): self
    {
        if ($this->burgers->removeElement($burger)) {
            $burger->removeMenu($this);
        }

        return $this;
    }

}
