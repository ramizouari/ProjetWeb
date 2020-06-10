<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        for($i=1;$i<=100;$i++)
        {
            $user=new User();
            $user->setLastName("Last".$i);
            $user->setFirstName("First".$i);
            $user->setEmail("user".$i."@gmail.com");
            $user->setUsername("username".$i);
            $user->setPasswordHash($this->passwordEncoder->encodePassword($user,"Random".$i));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
