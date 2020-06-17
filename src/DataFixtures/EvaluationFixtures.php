<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Evaluation;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class EvaluationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create();
        $T=array();
        for($i=0;$i<200;$i++)
            array_push($T,$i+1);
        for($i=1;$i<=200;$i++)
        {
            shuffle($T);
            $m=$faker->numberBetween(0,200);
            if($m>0) for($j=0;$j<$m;$j++)
            {
                $eval=new Evaluation();
                $eval->setBookId($i);
                $eval->setUserId($T[$j]);
                $eval->setNote($faker->numberBetween(0,10));
                $manager->persist($eval);
            }
            $manager->flush();
        }
       
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            BookFixtures::class
        );
    }
}
