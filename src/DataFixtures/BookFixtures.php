<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1;$i<=100;$i++)
        {
            $book=new Book();
            $book->setTitle("Title".$i);
            $book->setAuthor("Author".$i);
            $manager->persist($book);
        }
        $manager->flush();
    }
}
