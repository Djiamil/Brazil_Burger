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
class Complement {





  
}
