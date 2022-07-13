<?php

namespace App\Entity;

use App\Entity\Complement;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PortionFritesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PortionFritesRepository::class)]
#[ApiResource]
class PortionFrites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'portionFrites', targetEntity: Complement::class)]
    private $complement;

    public function __construct()
    {
        $this->complement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Complement>
     */
    public function getComplement(): Collection
    {
        return $this->complement;
    }

    public function addComplement(Complement $complement): self
    {
        if (!$this->complement->contains($complement)) {
            $this->complement[] = $complement;
            $complement->setPortionFrites($this);
        }

        return $this;
    }

    public function removeComplement(Complement $complement): self
    {
        if ($this->complement->removeElement($complement)) {
            // set the owning side to null (unless already changed)
            if ($complement->getPortionFrites() === $this) {
                $complement->setPortionFrites(null);
            }
        }

        return $this;
    }
}
