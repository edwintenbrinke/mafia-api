<?php

namespace App\Repository;

use App\Entity\Cooldown;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cooldown|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cooldown|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cooldown[]    findAll()
 * @method Cooldown[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CooldownRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cooldown::class);
    }

    // /**
    //  * @return Cooldown[] Returns an array of Cooldown objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cooldown
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
