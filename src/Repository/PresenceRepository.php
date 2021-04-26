<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Entity\Presence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Presence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Presence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Presence[]    findAll()
 * @method Presence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresenceRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct
    (
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, Presence::class);
        $this->manager = $manager;
    }

    // /**
    //  * @return Presence[] Returns an array of Presence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Presence
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function savePresence($CIN)
    {
        $newPresence = new Presence();

        $newPresence
            ->setCIN($CIN);

        $this->manager->persist($newPresence);
        $this->manager->flush();
    }
    public function updatePresence(Presence $presence): Presence
    {
        $this->manager->persist($presence);
        $this->manager->flush();

        return $presence;
    }
    public function removePresence(Presence $presence)
    {
        $this->manager->remove($presence);
        $this->manager->flush();
    }
}
