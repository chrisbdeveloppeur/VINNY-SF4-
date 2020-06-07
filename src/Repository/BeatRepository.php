<?php

namespace App\Repository;

use App\Entity\Beat;
use App\Entity\BeatSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


/**
 * @method Beat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beat[]    findAll()
 * @method Beat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beat::class);
    }

    public function findByBpm($value)
    {
            return $this->createQueryBuilder('d')
                ->andWhere('d.bpm <= :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getResult()
                ;
    }

    public function findByIframe($value)
    {
        return $this->createQueryBuilder('b')
            ->where('b.iframe = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
            ;
    }

}
