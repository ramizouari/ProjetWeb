<?php

namespace App\DataFixtures;
use App\Entity\UserFollowedUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFollowedUserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $T=array();
        for($i=0;$i<200;$i++)
            for($j=0;$j<200;$j++)
                array_push($T,[$i+1,$j+1]);
        shuffle($T);
        for($i=0;$i<5000;$i++)
        {
            $userFollowedUser=new UserFollowedUser();
            $userFollowedUser->setFollowerId($T[$i][0]);
            $userFollowedUser->setFollowedId($T[$i][1]);
            $manager->persist($userFollowedUser);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
