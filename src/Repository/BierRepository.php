<?php

namespace App\Repository;

use App\Entity\Bier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bier[]    findAll()
 * @method Bier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bier::class);
    }

    public function getAantal() {
//        $qb = $this->createQueryBuilder("b");
//        $qb->select($qb->expr()->count("b"));
//        //$query = $qb->getQuery();
//        return $qb->getQuery()->getSingleScalarResult();

        $qb = $this->createQueryBuilder("b");
            $qb->select($qb->expr()->count("b.id"));
        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (NoResultException $e) {
        } catch (NonUniqueResultException $e) {
        }
    }

    public function findBySoort(int $id) {
        $qb = $this->createQueryBuilder("b");
        $qb->select("b.naam AS bier_naam")
            ->addSelect("b.id AS bier_id")
            ->addSelect("b.prijs")
            ->addSelect("s.naam AS soort_naam")
            ->addSelect("s.id AS soort_id")
            ->addSelect("br.naam AS brouwer_naam")
            ->addSelect("br.id AS brouwer_id")
            ->innerJoin("b.brouwer", "br")
            ->innerJoin("b.soort", "s")
            ->where("b.soort = :id")
            ->setParameter("id", $id);

        return $qb->getQuery()->getResult();
    }

    public function findByBrouwer(int $id) {
        $qb = $this->createQueryBuilder("b");
        $qb->select("b.naam AS bier_naam")
            ->addSelect("b.id AS bier_id")
            ->addSelect("b.prijs")
            ->addSelect("s.naam AS soort_naam")
            ->addSelect("s.id AS soort_id")
            ->addSelect("br.naam AS brouwer_naam")
            ->addSelect("br.id AS brouwer_id")
            ->innerJoin("b.brouwer", "br")
            ->innerJoin("b.soort", "s")
            ->where("b.brouwer = :id")
            ->setParameter("id", $id);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param int         $limit
     * @param int         $offset
     *
     * @returns array
     */
    public function findPaginated($limit, $offset)
    {
        $qb = $this->createQueryBuilder('b');

        $qb->setMaxResults($limit)->setFirstResult($offset);

        return $qb->getQuery()->getResult(Query::HYDRATE_SIMPLEOBJECT);
    }

    // /**
    //  * @return Bier[] Returns an array of Bier objects
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
    public function findOneBySomeField($value): ?Bier
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
