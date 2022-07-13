<?php
namespace App\Datapersisters;

use DateTime;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class CommandeDatapersister implements ContextAwareDataPersisterInterface
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
        return $data instanceof Commande;
    }

    /**
     * @param Commande $data
     */
    public function persist($data, array $context = [])
    {
        $commande = $data->getLigneCommandes();
        foreach ($commande as $cmd) {
            
           $prix = $cmd->getProduit()->getPrix();
           $qunt = $cmd->getQuantite();
        }
        $price = ($prix*$qunt);
        $data ->setDateCommande(new DateTime());
        dd($price);
        $data ->setNumComande("MD".new \DateTime()."D");
        $data ->setIsEtatComande("En cours");
        $data->setPaiement($price);
       
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