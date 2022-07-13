<?php

namespace App\Entity;

use App\Entity\Complement;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TailleBoissonRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: TailleBoissonRepository::class)]
#[ApiResource]
class TailleBoisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;
    #[ORM\ManyToMany(targetEntity: Boisson::class, mappedBy: 'tailleboissons')]
    private $boissons;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    public function __construct()
    {
        $this->boissons = new ArrayCollection();
    }

 public function getId(): ?int
                                         {
                                             return $this->id;
                                         }

    /**
     * @return Collection<int, Boisson>
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(Boisson $boisson): self
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons[] = $boisson;
            $boisson->addTailleboisson($this);
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        if ($this->boissons->removeElement($boisson)) {
            $boisson->removeTailleboisson($this);
        }

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

}
