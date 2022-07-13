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

/**
 *
 */
class dataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;
    private $_passwordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordEncoder,mailservice $envoimail
    ) {
        $this->_entityManager = $entityManager;
        $this->_passwordEncoder = $passwordEncoder;
        $this->envoimail = $envoimail;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
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
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }


    public function gestionair($ges, array $context = []): bool
    {
        return $ges instanceof Gestionair;
    }
    public function burger($burg, array $context = []): bool
    {
        return $burg instanceof Burger;
    }
    /**
     * @param Burger $burg
     */
    /**
     * @param Gestionair $ges
     */

     public function recupges($ges, array $context = [],TokenInterface $token,EntityManagerInterface $entityManager,$burg, array $contexte = [])

     {
        $user = $this->ges->getToken()->getUser();
        $burg->setGestionair($user);
        dd($user);
        $this->entityManager->persist($ges);
        $this->entityManager->flush();
     }

}