<?php

namespace App\Repository;

use App\Entity\Evaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evaluation[]    findAll()
 * @method Evaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvaluationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evaluation::class);
    }

    // /**
    //  * @return Evaluation[] Returns an array of Evaluation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Evaluation
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getAverageNote($bookId)
    {
        $evaluations=$this->findBy(["bookId"=>$bookId]);
        //$exchangesRepo = $this->getDoctrine()->getRepository(Exchange::class);
        //$exchanges = $exchangesRepo->findBy(["bookId"=>$book->getId()]);
        //$exchangesNumber=count($exchanges);
        $averageNote=0;
        $n=count($evaluations);
        foreach($evaluations as $eval)
            $averageNote+=$eval->getNote();
        if($n) {
            $averageNote/=$n;
            $averageNote=round($averageNote,3);
        }
        else $averageNote=null;
        return array($averageNote,$n);
    }

    public function getNoteOrZero($bookId,$userId)
    {
        $eval=$this->findOneBy(["bookId"=>$bookId,"userId"=>$userId]);
        if(!$eval)
            return 0;
        else return $eval->getNote();
    }
}
