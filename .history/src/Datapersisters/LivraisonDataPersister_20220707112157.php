<?php
namespace App\Datapersisters;

use Date;
use DateTime;
use App\Entity\Livraison;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class LivraisonDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
    ) {
        $this-> entityManager = $entityManager;

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
        $livraison = $data->getLigneCommandes();
        foreach ($commande as $cmd) {
            
           $prix = $cmd->getProduit()->getPrix();
           $qunt = $cmd->getQuantite();
        }
        $price = ($prix*$qunt);
        
       $data = setEtatlivraison("livrai");
       
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