<?php

namespace App\Entity;

use Assert\NotNull;
use Assert\NotBlank;
use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
$validator = Validation::createValidator();

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource()]
class Menu extends Produit
{
    #[ORM\ManyToMany(targetEntity: Burger::class, mappedBy: 'menus')]
     /**
     * @Assert\Type(
     *     type="array",
     *     message="The value {{ $burgers}} is not a valid {{ array }}."
     * )
     */
    private $burgers;

    #[ORM\ManyToMany(targetEntity: Boisson::class, inversedBy: 'menus')]
    #[Assert\NotNull(groups: ['boissons'])]
    private $boissons;

    #[ORM\ManyToMany(targetEntity: Frite::class, inversedBy: 'menus')]
    private $frites;

    

    public function __construct()
    {
        // $constraint = new Assert\Collection([
        //     'tags' => new Assert\Optional([
        //         new Assert\Type($this->burgers = new ArrayCollection()),
        //     ])
        //     ]);
        $this->burgers = new ArrayCollection();
        $this->boissons = new ArrayCollection();
        $this->frites = new ArrayCollection();
    }

    /**
     * @return Collection<int, Burger>
     */
    public function getBurgers(): Collection
    {
        return $this->burgers;
    }

    public function addBurger(Burger $burger): self
    {
        if (!$this->burgers->contains($burger)) {
            $this->burgers[] = $burger;
            $burger->addMenu($this);
        }

        return $this;
    }

    public function removeBurger(Burger $burger): self
    {
        if ($this->burgers->removeElement($burger)) {
            $burger->removeMenu($this);
        }

        return $this;
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
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        $this->boissons->removeElement($boisson);

        return $this;
    }

    /**
     * @return Collection<int, Frite>
     */
    public function getFrites(): Collection
    {
        return $this->frites;
    }

    public function addFrite(Frite $frite): self
    {
        if (!$this->frites->contains($frite)) {
            $this->frites[] = $frite;
        }

        return $this;
    }

    public function removeFrite(Frite $frite): self
    {
        $this->frites->removeElement($frite);

        return $this;
    }

}
