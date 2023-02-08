<?php

namespace App\DataFixtures;

use App\Entity\Companies;
use App\Entity\Teams;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TeamsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $companies = $manager->getRepository(Companies::class)->findAll();
        
        for ($i = 1; $i <= 3; $i++) {
            $team = new Teams();
            $team->setName('Team '.$i);
            $team->setEnabled(true);
            $team->setProjectDescription('Project description '.$i);
            $team->setCompanies($companies[($i-1) % 3]);
            $manager->persist($team);
        }

        $manager->flush();
    }
}
