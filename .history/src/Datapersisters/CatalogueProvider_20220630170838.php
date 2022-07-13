<?php
// src/DataPersister/UserDataPersister.php

namespace App\Datapersisters;

use App\Entity\User;
use App\Entity\Burger;
use App\Entity\Produit;
use App\Entity\Gestionair;
use App\Repository\MenuRepository;
use App\Repository\BurgerRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Entity\Catalogue;

class CatalogueProvider implements ContextAwareCollectionDataProviderInterface,RestrictedDataProviderInterface
{

 
    public function __construct(
        MenuRepository $menuRepository,
        BurgerRepository $burgerRepository
       
    ) {
        $this->menuRepository = $menuRepository;
        $this->burgerRepository = $burgerRepository;
    }

    /**
     * {@inheritdoc}
     */

public function getCollection(string $ressourceClass,string $operationName=null, array $context = [])
    {

       return $context = [
        $this->burgerRepository->findAll(),
        $this->menuRepository->findAll()
        ];
    }

    
    public function supports(string $ressourceClass,string $operationName = null,array $context = []): bool
    {
        return $ressourceClass=== Catalogue::class;
    }



}