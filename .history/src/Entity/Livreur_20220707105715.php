<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreurRepository;
use ApiPlatform\Core\Annotation\ApiResource;
#[ApiResource()]

#[ORM\Entity(repositoryClass: LivreurRepository::class)]
class Livreur extends User
{
    #[ORM\Column(type: 'string', length: 255)]
    private $matMoto;

    #[ORM\Column(type: 'string', length: 255)]
    private $telephone;

    #[ORM\OneToMany(mappedBy: 'livreur', targetEntity: Livraison::class)]
    private $livraison;

    public function __construct()
    {
        parent::__construct();
        $this->livraison = new ArrayCollection();
    }

  

    public function getMatMoto(): ?string
    {
        return $this->matMoto;
    }

    public function setMatMoto(string $matMoto): self
    {
        $this->matMoto = $matMoto;

        return $this;
    }



    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraison(): Collection
    {
        return $this->livraison;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraison->contains($livraison)) {
            $this->livraison[] = $livraison;
            $livraison->setLivreur($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraison->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getLivreur() === $this) {
                $livraison->setLivreur(null);
            }
        }

        return $this;
    }
}
