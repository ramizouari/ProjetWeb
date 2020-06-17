<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;
use Faker\Provider\fr_FR\Person;
use Faker\Provider\fr_FR\PhoneNumber;
use Faker\Provider\Internet;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
    // generate data by accessing properties
        for($i=1;$i<=200;$i++)
        {
            $firstName=$faker->firstName();
            $lastName=$faker->lastName();
            $domain=$faker->freeEmailDomain();
            $user=new User();
            $user->setLastName($lastName);
            $user->setFirstName($firstName);
            $user->setEmail(strtolower($firstName).'.'.strtolower($lastName)."@".$domain);
            $user->setUsername("username".$i);
            $user->setPasswordHash($this->passwordEncoder->encodePassword($user,"Random".$i));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
