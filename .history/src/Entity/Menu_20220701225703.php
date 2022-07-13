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

#[ApiResource(
    collectionOperations: [
        "post" => [
            "normalization_context" =>['groups'=>'read:simple'],
            "denormalization_context" =>['groups'=>'writes']
        ],
        "get"=>[
            "normalization_context" =>['groups'=>'menu:read:All']
        ]
    ]
)]
class Menu extends Produit
{

    #[ORM\ManyToMany(targetEntity: Complement::class, inversedBy: 'menus')]
    #[Groups(['read:simple','writes'])]
    private $complements;






    /**
     * @return Collection<int, Complement>
     */
    public function getComplements(): Collection
    {
        return $this->complements;
    }

    public function addComplement(Complement $complement): self
    {
        if (!$this->complements->contains($complement)) {
            $this->complements[] = $complement;
        }

        return $this;
    }

    public function removeComplement(Complement $complement): self
    {
        $this->complements->removeElement($complement);

        return $this;
    }

}
