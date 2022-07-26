<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissonRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
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
class Boisson extends Produit
{
    #[ORM\Column(type: 'integer')]
    #[Groups('write')]

    private $quantityStock;

    #[ORM\ManyToOne(targetEntity: TailleBoisson::class, inversedBy: 'boissons')]
    #[Groups('write')]
    private $tailleBoissons;

    public function getQuantityStock(): ?int
    {
        return $this->quantityStock;
    }

    public function setQuantityStock(int $quantityStock): self
    {
        $this->quantityStock = $quantityStock;

        return $this;
    }

    public function getTailleBoissons(): ?TailleBoisson
    {
        return $this->tailleBoissons;
    }

    public function setTailleBoissons(?TailleBoisson $tailleBoissons): self
    {
        $this->tailleBoissons = $tailleBoissons;

        return $this;
    }
}
