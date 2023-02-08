<?php

namespace App\DataFixtures;

use App\Entity\Companies;
use App\Entity\Incluscore;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class IncluscoreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $companies = $manager->getRepository(Companies::class)->findAll();

        for ($i = 0; $i < 3 ; $i++)
        $incluscore = new Incluscore();
        $incluscore->setName('Incluscore '.$i);
        $incluscore->setSmallname('inc'.$i);
        $incluscore->setEnabled(true);
        $incluscore->setCanBePublic(true);
        $incluscore->setDescription('This is the first Incluscore' .$i);
        $incluscore->setIsInclucard(false);
        $incluscore->setQuizzLink('https://quizz.com/incluscore'.$i);
        $incluscore->setCompany($companies[($i-1) % 3]);
        $manager->persist($incluscore);

        $manager->flush();
    }
}
