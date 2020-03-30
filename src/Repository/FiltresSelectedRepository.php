<?php

namespace App\Repository;

use App\Entity\FiltresSelected;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FiltresSelected|null find($id, $lockMode = null, $lockVersion = null)
 * @method FiltresSelected|null findOneBy(array $criteria, array $orderBy = null)
 * @method FiltresSelected[]    findAll()
 * @method FiltresSelected[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FiltresSelectedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FiltresSelected::class);
    }

    // /**
    //  * @return FiltresSelected[] Returns an array of FiltresSelected objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FiltresSelected
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
