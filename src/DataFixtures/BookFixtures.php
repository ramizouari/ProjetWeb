<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use Faker\Factory;
use Faker\Provider\Person;
use App\Faker\BookFaker;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create();
        $faker->addProvider(new BookFaker($faker));
        for($i=1;$i<=200;$i++)
        {
            $book=new Book();
            $book->setTitle($faker->title($faker->numberBetween(1,3)));
            $book->setAuthor($faker->name);
            $book->setYear($faker->year());
            $book->setPagesNumber($faker->numberBetween(10,600));
            $manager->persist($book);
        }
        $manager->flush();
    }
}
