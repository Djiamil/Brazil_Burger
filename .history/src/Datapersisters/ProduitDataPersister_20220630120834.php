<?php
// src/DataPersister/UserDataPersister.php

namespace App\ProduitDataPersister;

use App\Entity\User;
use App\Entity\Burger;
use App\Entity\Gestionair;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class dataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;
    /**
     * @param Gestionair $ges
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
        return $data instanceof Burger ;
    }


    /**
     * @param Burger $data
    */
    public function recupges($data, array $context = [])

    {

       $data->setGestionair($this->ges);
    }

    public function persist($data, array $context = [])
    {
            
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