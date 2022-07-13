<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource(
    collectionOperations: [
        "post" => [
            "denormalization_context" =>['groupes:menu:write'],
            "normalization_context" =>['groupes:read:simple']
        ],
        "get"=>[
            "normalization_context" =>['groupes:menu:read:All']
        ]
    ]
)]
class Menu
{

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['menu:write','read:simple','read:All'])]
    private $nomMenu;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['menu:write','read:simple'])]

    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['menu:write','read:simple'])]
    private $descrption;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['menu:write'])]
    private $isEtat;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'menus')]
    #[Groups(['menu:write','read:simple','read:All'])]
    private $burgers;

    #[ORM\ManyToMany(targetEntity: Complement::class, inversedBy: 'menus')]
    #[Groups(['menu:write','read:simple'])]
    private $complements;

    

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }
    public function getNomMenu(): ?string
    {
        return $this->nomMenu;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
    public function setNomMenu(string $nomMenu): self
    {
        $this->nomMenu = $nomMenu;

        return $this;
    }

    public function getDescrption(): ?string
    {
        return $this->descrption;
    }

    public function setDescrption(string $descrption): self
    {
        $this->descrption = $descrption;

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

    /**
     * @return Collection<int, self>
     */
    public function getBurgers(): Collection
    {
        return $this->burgers;
    }

    public function addBurger(self $burger): self
    {
        if (!$this->burgers->contains($burger)) {
            $this->burgers[] = $burger;
        }

        return $this;
    }

    public function removeBurger(self $burger): self
    {
        $this->burgers->removeElement($burger);

        return $this;
    }






    /**
     * @return Collection<int, Complement>
     */
    public function getComplements(): Collection
    {
        return $this->complements;
    }

    public function addComplement(Complement $complement): self
    {
        if (!$this->complements->contains($complement)) {
            $this->complements[] = $complement;
        }

        return $this;
    }

    public function removeComplement(Complement $complement): self
    {
        $this->complements->removeElement($complement);

        return $this;
    }

}
