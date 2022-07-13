<?php
// src/DataPersister/UserDataPersister.php

namespace App\Datapersisters;


use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;



class ProduitDataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;
    private $tokenStorage;
    private $types;

    /**
     * @param User $ges
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage
    ) {
        $this->_entityManager = $entityManager;
        $this-> ges = $tokenStorage->getToken()->getUser();
      
        
    
    }
    
    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Produit or $data instanceof Menu;
    }


    /**
     * @param Produit $data
    */
    public function recupges($data, array $context = [])

    {

       $data->setGestionair($this->ges);
 
    }
/**
     * @param Menu $data
    */
    public function persist($data, array $context = [])
    {
        if($data instanceof Menu){
            if($data->getBurgers()){
            $message = "veiller dabord ajouter un burger";
            }
        }
        $this->recupges($data);
        $this->_entityManager->persist($data);
        $this->_entityManager->flush();

    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }

}