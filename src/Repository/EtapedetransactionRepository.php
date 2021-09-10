<?php

namespace App\Repository;

use App\Entity\Etapedetransaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etapedetransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etapedetransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etapedetransaction[]    findAll()
 * @method Etapedetransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtapedetransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etapedetransaction::class);
    }

    // /**
    //  * @return Etapedetransaction[] Returns an array of Etapedetransaction objects
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
    public function findOneBySomeField($value): ?Etapedetransaction
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
