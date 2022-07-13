<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissonRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
#[ApiResource]
class Boisson extends Produit
{

    #[ORM\OneToMany(mappedBy: 'boisson', targetEntity: MenuBoisson::class)]
    private $menuBoissons;

    public function __construct()
    {
        $this->tailleboissons = new ArrayCollection();
        $this->menuBoissons = new ArrayCollection();
    }

    /**
     * @return Collection<int, TailleBoisson>
     */
    public function getTailleboissons(): Collection
    {
        return $this->tailleboissons;
    }

    public function addTailleboisson(TailleBoisson $tailleboisson): self
    {
        if (!$this->tailleboissons->contains($tailleboisson)) {
            $this->tailleboissons[] = $tailleboisson;
        }

        return $this;
    }

    public function removeTailleboisson(TailleBoisson $tailleboisson): self
    {
        $this->tailleboissons->removeElement($tailleboisson);

        return $this;
    }

    /**
     * @return Collection<int, MenuBoisson>
     */
    public function getMenuBoissons(): Collection
    {
        return $this->menuBoissons;
    }

    public function addMenuBoisson(MenuBoisson $menuBoisson): self
    {
        if (!$this->menuBoissons->contains($menuBoisson)) {
            $this->menuBoissons[] = $menuBoisson;
            $menuBoisson->setBoisson($this);
        }

        return $this;
    }

    public function removeMenuBoisson(MenuBoisson $menuBoisson): self
    {
        if ($this->menuBoissons->removeElement($menuBoisson)) {
            // set the owning side to null (unless already changed)
            if ($menuBoisson->getBoisson() === $this) {
                $menuBoisson->setBoisson(null);
            }
        }

        return $this;
    }
}
