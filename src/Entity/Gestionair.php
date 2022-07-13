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
    #[ApiSubresource()]
    private $produits;

    #[ORM\OneToMany(mappedBy: 'gestionair', targetEntity: Commande::class)]
    private $commandes;

    #[ORM\OneToMany(mappedBy: 'gestionairs', targetEntity: Livraison::class)]
    private $livraisons;

    public function __construct()
    {
        parent::__construct();
        $this->produits = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->livraisons = new ArrayCollection();
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

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setGestionair($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getGestionair() === $this) {
                $commande->setGestionair(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons[] = $livraison;
            $livraison->setGestionairs($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getGestionairs() === $this) {
                $livraison->setGestionairs(null);
            }
        }

        return $this;
    }
}
