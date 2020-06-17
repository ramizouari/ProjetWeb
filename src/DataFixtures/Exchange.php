<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Exchange extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker=Factory::create();
        for($i=0;$i<200;$i++)
        {
          $echange= new Exchange();
          $echange->setRequesterId($faker->numberBetween(1,200));
          $echange->setResponderId($faker->numberBetween(1,200));
          $echange->setState($faker->numberBetween(0,3));
          $echange->setRequestedBookId($faker->numberBetween(1,200));
          $echange->setRespondedBookId($faker->numberBetween(1,200));
          $manager->persist($echange);

    }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            userFixtures::class,
            BookFixtures::class,
            BookFixtures::class
        );
    }

}
