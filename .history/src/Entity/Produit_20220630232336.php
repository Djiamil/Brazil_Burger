<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type",type:"string")]
#[ORM\DiscriminatorMap(["burger"=>"Burger","complement"=>"Complement","menu"=>"Menu","frites"=>"PortionFrites","boisson"=>"TailleBoisson"])]

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get"=>[
            'normalization_context' => ['groups' => 'Burger:read:simple'],
        ]
    ]
)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['Burger:read:all','read:simple','groups'=>'write'])]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['Burger:read:simple','Burger:read:all','groups' => 'write'])]
    protected $image;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['Burger:read:simple','Burger:read:all','groups' => 'write'])]
    protected $description;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['Burger:read:simple','Burger:read:all','groups' => 'write'])]
    protected $nom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['Burger:read:simple','groups' => 'write'])]
    protected $prix;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['groups' => 'write'])]

    protected $isEtat=true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function isIsEtat(): ?bool
    {
        return $this->isEtat;
    }

    public function setIsEtat(bool $isEtat): self
    {
        $this->isEtat = $isEtat;

        return $this;
    }
}
