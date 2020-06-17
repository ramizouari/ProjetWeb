<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\UserFollowedBook;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class UserFollowedBookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create();
        $T=array();
        for($i=0;$i<200;$i++)
            for($j=0;$j<200;$j++)
                array_push($T,[$i+1,$j+1]);
        shuffle($T);
        for($i=0;$i<5000;$i++)
        {
            $userFollowedBook=new UserFollowedBook();
            $userFollowedBook->setUserId($T[$i][0]);
            $userFollowedBook->setBookId($T[$i][1]);
            $manager->persist($userFollowedBook);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            BookFixtures::class
        );
    }
}
