<?php

namespace App\Entity;

use Assert\NotBlank;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Faker\Provider\ar_EG\Person;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type",type:"string")]
#[ORM\DiscriminatorMap(["burger"=>"Burger","menu"=>"Menu","frites"=>"Frite","boisson"=>"Boisson"])]

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
    #[Groups(['Burger:read:all','read:simple','groups' => 'write',])]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['Burger:read:simple','Burger:read:all','groups' => 'write'])]
    protected $image;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['Burger:read:simple','Burger:read:all','groups' => 'write'])]
    protected $description;

    #[Groups(['Burger:read:simple',
    'Burger:read:all',
    'write'
    ])]
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message:"ne doit pas etre vide")]
    protected $nom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['Burger:read:simple','groups' => 'write'])]
    protected $prix;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['groups' => 'write'])]

    protected $isEtat=true;
    

    #[ORM\ManyToOne(targetEntity: Gestionair::class, inversedBy: 'produits')]
    #[Groups(['groups' => 'Burger:read:all'])]
    private $gestionair;

 

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: LigneCommande::class)]
    private $ligneCommandes;

    public function __construct()
    {
        $this->ligneCommandes = new ArrayCollection();
    }

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

    public function getGestionair(): ?Gestionair
    {
        return $this->gestionair;
    }

    public function setGestionair(?Gestionair $gestionair): self
    {
        $this->gestionair = $gestionair;

        return $this;
    }

    /**
     * @return Collection<int, LigneCommande>
     */
    public function getLigneCommandes(): Collection
    {
        return 1;
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setProduit($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getProduit() === $this) {
                $ligneCommande->setProduit(null);
            }
        }

        return $this;
    }
}
