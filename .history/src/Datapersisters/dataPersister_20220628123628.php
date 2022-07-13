<?php
// src/DataPersister/UserDataPersister.php

namespace App\Datapersisters;

use App\Entity\User;
use App\Entity\Burger;
use App\Entity\Client;
use App\Entity\Gestionair;
use App\Service\mailservice;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 *
 */
class dataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;
    private $_passwordEncoder;
    /**
     * @param Gestionair $ges
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordEncoder,mailservice $envoimail,
        TokenStorageInterface $tokenStorage
    ) {
        $this->_entityManager = $entityManager;
        $this->_passwordEncoder = $passwordEncoder;
        $this->envoimail = $envoimail;
        $this-> ges = $tokenStorage->getToken()->getUser();
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User or $data instanceof Burger ;
    }


    /**
     * @param Burger $data
    */
    public function recupges($data, array $context = [])

    {

       $data->setGestionair($this->ges);
       // $user = $this->ges->getToken()->getUser();
       // $burg->setGestionair($user);
       // $this->Manager->persist($ges);
       // $this->Manager->flush();
       // dd($user);
    }

    /**
     * @param User $data
     */
    public function persist($data, array $context = [])
    {
        if ($data->getPlainPassword()) {
            $data->setPassword(
                $this->_passwordEncoder->HashPassword(
                    $data,
                    $data->getPlainPassword()
                )
            );

            $data->eraseCredentials();
        }

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
        $this-> envoimail -> sendMail($data);
    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        $this->recupges();
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }


   
    


}