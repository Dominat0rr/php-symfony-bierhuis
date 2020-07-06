<?php

namespace App\Repository;

use App\Entity\Bestelbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bestelbon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bestelbon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bestelbon[]    findAll()
 * @method Bestelbon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BestelbonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bestelbon::class);
    }

    /**
     * @param Bestelbon $bestelbon
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Bestelbon $bestelbon) {
        $em = $this->getEntityManager();
        $em->persist($bestelbon);
        $em->flush();
    }

    // /**
    //  * @return Bestelbon[] Returns an array of Bestelbon objects
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
    public function findOneBySomeField($value): ?Bestelbon
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
