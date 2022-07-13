<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ComplementRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type",type:"string")]
#[ORM\DiscriminatorMap(["tailleBoisson"=>"TailleBoisson","portionFrite"=>"PortionFrites"])]

#[ORM\Entity(repositoryClass: ComplementRepository::class)]
#[ApiResource]
class Complement extends Produit
{

    #[ORM\Column(type: 'string', length: 255)]
    private $nature;

    #[ORM\ManyToOne(targetEntity: PortionFrites::class, inversedBy: 'complement')]
    private $portionFrites;

    #[ORM\ManyToOne(targetEntity: TailleBoisson::class, inversedBy: 'complement')]
    private $tailleBoissons;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'complements')]
    private $menus;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getPortionFrites(): ?PortionFrites
    {
        return $this->portionFrites;
    }

    public function setPortionFrites(?PortionFrites $portionFrites): self
    {
        $this->portionFrites = $portionFrites;

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

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->addComplement($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeComplement($this);
        }

        return $this;
    }
}
