<?php

namespace App\Repository;

use App\Entity\Dd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dd[]    findAll()
 * @method Dd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dd::class);
    }

    // /**
    //  * @return Dd[] Returns an array of Dd objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dd
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
