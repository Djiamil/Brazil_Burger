<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $client = new Client();
        $client->setPassword('passer123');
        $client->setEmail("moustapha45@gmail.com");
        $client->setNom("Der");
        $client->setPrenom("Moustapha");
        $client->setTelephone("77 348 89 29");
        $client->setRoles(["ROLE_CLIENT"]);

        $manager->persist($client);

        $manager->flush();
    }
}
