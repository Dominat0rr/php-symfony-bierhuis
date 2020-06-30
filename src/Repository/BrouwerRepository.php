<?php

namespace App\Repository;

use App\Entity\Brouwer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Brouwer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brouwer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brouwer[]    findAll()
 * @method Brouwer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrouwerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brouwer::class);
    }

    // /**
    //  * @return Brouwer[] Returns an array of Brouwer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Brouwer
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
