<?php

namespace App\Repository;

use App\Entity\Bestelbonlijn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bestelbonlijn|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bestelbonlijn|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bestelbonlijn[]    findAll()
 * @method Bestelbonlijn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BestelbonlijnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bestelbonlijn::class);
    }

    /**
     * @param Bestelbonlijn $bestelbonlijn
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Bestelbonlijn $bestelbonlijn) {
        $em = $this->getEntityManager();
        $em->persist($bestelbonlijn);
        $em->flush();
    }

    // /**
    //  * @return Bestelbonlijn[] Returns an array of Bestelbonlijn objects
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
    public function findOneBySomeField($value): ?Bestelbonlijn
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
