<?php

namespace App\Repository;

use App\Entity\UserFollowedUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserFollowedUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFollowedUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFollowedUser[]    findAll()
 * @method UserFollowedUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFollowedUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFollowedUser::class);
    }

    // /**
    //  * @return UserFollowedUser[] Returns an array of UserFollowedUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserFollowedUser
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
