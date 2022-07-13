<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuRepository::class)]

#[ApiResource(
    collectionOperations: [
        "post" => [
            "normalization_context" =>['groups'=>'read:simple'],
            "denormalization_context" =>['groups'=>'writes']
        ],
        "get"=>[
            "normalization_context" =>['groups'=>'menu:read:All']
        ]
    ]
)]
class Menu extends Produit
{

}
