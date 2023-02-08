<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Companies;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // get all the companies
        $companies = $manager->getRepository(Companies::class)->findAll();
        
        for ($i = 1; $i <= 3; $i++) {
            $user = new User();
            $user->setAvatarImgPath('user'.$i.'.jpg');
            $user->setLang('en');
            $user->setTeamId($i);
            $user->setHasAPassword(true);
            $user->setFirstName('John '.$i);
            $user->setLastName('Doe '.$i);
            $user->setEnabled(true);
            $user->setEmail('johndoe'.$i.'@example.com');
            $user->setPwd('password'.$i);
            $user->setSuperAdmin(false);
            // set the company
            $user->setCompanies($companies[($i-1) % 3]);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
