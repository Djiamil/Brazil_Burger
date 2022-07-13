<?php
namespace App\Datapersisters;

use Date;
use DateTime;
use App\Entity\Livraison;
use Doctrine\SqlFormatter\Token;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LivraisonDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,TokenStorageInterface $tokenStorage
    ) {
        $this-> entityManager = $entityManager;
        $this-> ges = $tokenStorage->getToken()->getUser();

    }
    public function recupges($data, array $context = [])

    {

       $data->setGestionair($this->ges);
 
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Livraison;
    }

    /**
     * @param Livraison $data
     */
    public function persist($data, array $context = [])
    {
        // $livraison = $data->getLigneCommandes();
        // foreach ($commande as $cmd) {
            
        //    $prix = $cmd->getProduit()->getPrix();
        //    $qunt = $cmd->getQuantite();
        // }
        // $price = ($prix*$qunt);
        
       
       $data->setEtatlivraison("Livrair");
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }

}