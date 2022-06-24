<?php

namespace App\DataFixtures;

use App\Entity\Gestionair;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GestionnaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $gestionair = new Gestionair();
        $gestionair->setPassword('passer123');
        $gestionair->setEmail("loMbaye45@gmail.com");
        $gestionair->setNom("Lo");
        $gestionair->setPrenom("Mbaye");
        $gestionair->setRoles(["ROLE_GESTIONAIR"]);
        $manager->persist($gestionair);

        $manager->flush();
    }
}
