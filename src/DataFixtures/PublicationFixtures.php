<?php

namespace App\DataFixtures;

use App\Entity\Publication;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class PublicationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create();
        for($i=0;$i<5000;$i++)
        {
            $publication = new Publication();
            $publication->setUserId($faker->numberBetween(1,200));
            $publication->setBookId($faker->numberBetween(1,200));
            $publication->setText($faker->paragraph($faker->numberBetween(5,7)));
            $manager->persist($publication);
        }
        // $product = new Product();
        // $manager->persist($product);

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
