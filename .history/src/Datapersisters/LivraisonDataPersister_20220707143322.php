<?php
namespace App\Datapersisters;


use App\Entity\Livraison;
use Doctrine\SqlFormatter\Token;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LivraisonDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;
    /**
     * @param User $ges
     */
    public function __construct(
        EntityManagerInterface $entityManager,TokenStorageInterface $tokenStorage
    ) {
        $this-> entityManager = $entityManager;
        $this-> ges = $tokenStorage->getToken()->getUser();

    }
    public function recupges($data, array $context = [])

    {

       $data->setGestionairs($this->ges);
 
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
        $status = $data->getCommandes();
        dd($status);
        foreach ($status as $sta) {
            dd($sta);
        }
        
        $data->setEtatlivraison("Livrair");
        $this->recupges($data);
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