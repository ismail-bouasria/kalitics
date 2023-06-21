<?php

namespace App\DataFixtures;

use App\Entity\Utilisateurs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UtilisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i= 1; $i<=10; $i++){
            $user = new Utilisateurs();
            $user->setNom("Nom$i")
                 ->setPrenom("Prenom$i")
                 ->setMatricule("Matricule$i");
            $manager->persist($user);
        }

        $manager->flush();
    }
}
