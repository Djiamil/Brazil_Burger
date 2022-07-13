<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource]
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
    private $payement;

    #[ORM\Column(type: 'boolean')]
    private $isEtat;

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

    public function isIsEtatPayement(): ?bool
    {
        return $this->isEtatPaiement;
    }

    public function setIsEtatPayement(bool $isEtatPaiement): self
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

    public function getPayement(): ?string
    {
        return $this->paiement;
    }

    public function setPayement(string $paiement): self
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
}
