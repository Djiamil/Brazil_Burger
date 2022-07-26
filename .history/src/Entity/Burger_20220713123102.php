<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get"=>[
            'normalization_context' => ['groups' => 'Burger:read:simple'],
        ],
    "post" => [
        "security" => "is_granted('ROLE_GESTIONAIS')",
        "security_message" => "Vous avez pas access a cette rtessource",
        "denormalization_context" => ['groups' => 'write'],

    ],
],
    itemOperations: [
        "put"=>[
        "security" => "is_granted('ROLE_GESTIONAIR')",
        "security_message" => "Vous avez pas access a cette rtessource",
        'normalization_context' => ['groups' => 'Burger:read:alls']
    ], 
    "get"=>[
        'normalization_context' => ['groups' => 'Burger:read:all']

    ]
    
    ]
)]
class Burger extends Produit
{


    // #[ORM\OneToMany(mappedBy: 'burger', targetEntity: MenuBurger::class)]
    // private $menuBurgers;

    // public function __construct()
    // {
    //     $this->menuBurgers = new ArrayCollection();
    // }

    

 

   
    // /**
    //  * @return Collection<int, MenuBurger>
    //  */
    // public function getMenuBurgers(): Collection
    // {
    //     return $this->menuBurgers;
    // }

    // public function addMenuBurger(MenuBurger $menuBurger): self
    // {
    //     if (!$this->menuBurgers->contains($menuBurger)) {
    //         $this->menuBurgers[] = $menuBurger;
    //         $menuBurger->setBurger($this);
    //     }

    //     return $this;
    // }

    // public function removeMenuBurger(MenuBurger $menuBurger): self
    // {
    //     if ($this->menuBurgers->removeElement($menuBurger)) {
    //         // set the owning side to null (unless already changed)
    //         if ($menuBurger->getBurger() === $this) {
    //             $menuBurger->setBurger(null);
    //         }
    //     }

    //     return $this;
    // }
}
