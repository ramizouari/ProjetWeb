<?php

namespace App\Repository;

use App\Entity\UserFollowedBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserFollowedBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFollowedBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFollowedBook[]    findAll()
 * @method UserFollowedBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFollowedBookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFollowedBook::class);
    }

    // /**
    //  * @return UserFollowedBook[] Returns an array of UserFollowedBook objects
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
    public function findOneBySomeField($value): ?UserFollowedBook
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
