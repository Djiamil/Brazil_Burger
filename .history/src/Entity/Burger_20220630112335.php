<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get"=>[
            'normalization_context' => ['groups' => 'Burger:read:simple'],
        ],
    "post" => [
        // "security" => "is_granted('ROLE_GESTIONAIR')",
        // "security_message" => "Vous avez pas access a cette rtessource",
        "denormalization_context" => ['groups' => 'write'],
        'normalization_context' => ['groups' => 'Burger:read:all']

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

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['Burger:read:simple','Burger:read:all'])]
    private $categorie;

    #[ORM\OneToMany(mappedBy: 'burgers', targetEntity: Catalogue::class)]
    private $catalogue;

    #[ORM\ManyToOne(targetEntity: Gestionair::class, inversedBy: 'burgers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['Burger:read:simple','Burger:read:all'])]
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
