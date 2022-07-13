<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GestionairRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

#[ApiResource()]
#[ORM\Entity(repositoryClass: GestionairRepository::class)]
class Gestionair extends User
{
    #[ORM\OneToMany(mappedBy: 'gestionair', targetEntity: Produit::class)]
    #[ApiSubresource(
        subresourceOperations: [
            'produitgestionnaires' => [
                'method' => 'GET',
                'path' => '/api/gestionairs/{id}/burgers',
                'denormalization_context' => [
                'groups' => ['list-burgers'],
            ],
            ],
        ],
    )]
    private $produits;

    public function __construct()
    {
        parent::__construct();
        $this->produits = new ArrayCollection();
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setGestionair($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getGestionair() === $this) {
                $produit->setGestionair(null);
            }
        }

        return $this;
    }
}
