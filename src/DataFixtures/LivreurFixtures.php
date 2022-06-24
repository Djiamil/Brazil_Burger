<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Livreur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LivreurFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;

    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i=1; $i < 50; $i++) { 

        $Livreur = new Livreur();
        $pass = "passer123";
        $password = $this->hasher->hashPassword($Livreur, $pass);
        $Livreur->setPassword($password);
        $Livreur->setEmail("$faker->email");
        $Livreur->setNom("$faker->firstName");
        $Livreur->setPrenom("$faker->lastName");
        $Livreur->setRoles(["ROLE_LIVREUR"]);
        $Livreur->setMatMoto(strtoupper($faker->word()));
        $manager->persist($Livreur);

        }

        $manager->flush();
    }
}
