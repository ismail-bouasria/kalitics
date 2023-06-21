<?php

namespace App\DataFixtures;

use App\Entity\Chantiers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChantiersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i= 1; $i<=10; $i++){
            $chantier = new Chantiers();
            $chantier->setNom("Chantier$i")
                ->setAdresse("Adresse$i")
                ->setDateDebut(new \DateTime());
            $manager->persist($chantier);
        }


        $manager->flush();
    }
}
