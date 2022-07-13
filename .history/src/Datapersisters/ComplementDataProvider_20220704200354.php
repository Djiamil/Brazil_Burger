<?php

namespace App\Datapersisters;

use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Entity\Complement;
use App\Repository\BoissonRepository;
use App\Repository\FriteRepository;

class ComplementDataProvider implements ContextAwareCollectionDataProviderInterface,RestrictedDataProviderInterface
{


    public function __construct(BoissonRepository $boissonRep,FriteRepository $friteRepo){
        $this->boissonRepo = $boissonRep;
        $this->friteRepo = $friteRepo;
    }

     /**
     * {@inheritdoc}
     */

public function getCollection(string $ressourceClass,string $operationName=null, array $context = [])
{

   return $context = [
    $this->boissonRepoy->findAll(),
    $this->friteRepo->findAll()
    ];
}
public function supports(string $ressourceClass,string $operationName = null,array $context = []): bool
    {
        return $ressourceClass=== Complement::class;
    }
}