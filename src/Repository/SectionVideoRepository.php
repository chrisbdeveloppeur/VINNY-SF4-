<?php

namespace App\Repository;

use App\Entity\SectionVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SectionVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method SectionVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method SectionVideo[]    findAll()
 * @method SectionVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SectionVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SectionVideo::class);
    }

    // /**
    //  * @return SectionVideo[] Returns an array of SectionVideo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SectionVideo
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
