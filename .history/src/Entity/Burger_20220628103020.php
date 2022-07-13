<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
    collectionOperations: ["get", "post"],
    itemOperations: ["put", "get"]
)]
class Burger extends Produit
{

    #[ORM\Column(type: 'string', length: 255)]
    private $categorie;

    #[ORM\OneToMany(mappedBy: 'burgers', targetEntity: Catalogue::class)]
    private $catalogue;

    #[ORM\ManyToOne(targetEntity: Gestionair::class, inversedBy: 'burgers')]
    #[ORM\JoinColumn(nullable: false)]
    private $gestionair;

    public function __construct()
    {
        $this->catalogue = new ArrayCollection();
    }


    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Catalogue>
     */
    public function getCatalogue(): Collection
    {
        return $this->catalogue;
    }

    public function addCatalogue(Catalogue $catalogue): self
    {
        if (!$this->catalogue->contains($catalogue)) {
            $this->catalogue[] = $catalogue;
            $catalogue->setBurgers($this);
        }

        return $this;
    }

    public function removeCatalogue(Catalogue $catalogue): self
    {
        if ($this->catalogue->removeElement($catalogue)) {
            // set the owning side to null (unless already changed)
            if ($catalogue->getBurgers() === $this) {
                $catalogue->setBurgers(null);
            }
        }

        return $this;
    }

    public function getGestionair(): ?Gestionair
    {
        return $this->gestionair;
    }

    public function setGestionair(?Gestionair $gestionair): self
    {
        $this->gestionair = $gestionair;

        return $this;
    }
}
