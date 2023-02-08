<?php

namespace App\DataFixtures;

use App\Entity\Companies;
use App\Entity\Teams;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompaniesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // get all the users
        $users = $manager->getRepository(User::class)->findAll();
        $teams = $manager->getRepository(Teams::class)->findAll();

        for ($i = 1; $i <= 3; $i++) {
            $company = new Companies();
            $company->setName('Company '.$i);
            $company->setImgPath('company'.$i.'.jpg');
            $company->addUser($users[($i-2) % 3]);
            $company->addTeam($teams[($i-2) % 3]);            
            $manager->persist($company);
        }

        $manager->flush();
    }
}
