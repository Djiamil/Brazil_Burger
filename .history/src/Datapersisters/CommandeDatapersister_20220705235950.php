<?php
namespace App\Datapersisters;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class dataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;
    private $_passwordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager,
    ) {
        $this->_entityManager = $entityManager;

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
        foreach ($commande as $cmd => $value) {
           $prix = $commande->cmd->getPrix();
            $quat= $commande->cmd ->getQuantite();
        }
        $price = ($prix*$quat);
        $data ->setDateCommande(new \DateTime());
        $data ->setNumComande("MD".new \DateTime()."D");
        $data->setPaiement($price);
       
       
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