<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
    collectionOperations: [
    "post"=>[
    "denormalization_context" => ['groupe'=>'commande:write']
        ]
    ]
    )]

class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $isEtatComande;

    #[ORM\Column(type: 'string', length: 255)]
    private $numComande;

    #[ORM\Column(type: 'date')]
    private $dateCommande;

    #[ORM\Column(type: 'boolean')]
    private $isEtatPaiement;

    #[ORM\Column(type: 'string', length: 255)]
    private $statutCommande;

    #[ORM\Column(type: 'string', length: 255)]
    private $paiement;

    #[ORM\Column(type: 'boolean')]
    private $isEtat;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commandes')]
    private $client;

    

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: LigneCommande::class)]
    #[Groups(['groupe'=>'commande:write'])]
    private $ligneCommandes;

    #[ORM\ManyToOne(targetEntity: Gestionair::class, inversedBy: 'commandes')]
    private $gestionair;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->ligneCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsEtatComande(): ?bool
    {
        return $this->isEtatComande;
    }

    public function setIsEtatComande(bool $isEtatComande): self
    {
        $this->isEtatComande = $isEtatComande;

        return $this;
    }

    public function getNumComande(): ?string
    {
        return $this->numComande;
    }

    public function setNumComande(string $numComande): self
    {
        $this->numComande = $numComande;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function isIsEtatPaiement(): ?bool
    {
        return $this->isEtatPaiement;
    }

    public function setIsEtatPaiement(bool $isEtatPaiement): self
    {
        $this->isEtatPaiement = $isEtatPaiement;

        return $this;
    }

    public function getStatutCommande(): ?string
    {
        return $this->statutCommande;
    }

    public function setStatutCommande(string $statutCommande): self
    {
        $this->statutCommande = $statutCommande;

        return $this;
    }

    public function getPaiement(): ?string
    {
        return $this->paiement;
    }

    public function setPaiement(string $paiement): self
    {
        $this->paiement = $paiement;

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
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
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        $this->produits->removeElement($produit);

        return $this;
    }

    /**
     * @return Collection<int, LigneCommande>
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getCommande() === $this) {
                $ligneCommande->setCommande(null);
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
