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

    public function findByBpmMin($min)
    {
            return $this->createQueryBuilder('d')
                ->andWhere('d.bpm >= :min')
                ->setParameter('min', $min)
                ->orderBy('d.updatedAt', 'DESC')
                ->getQuery()
                ->getResult()
                ;
    }

    public function findByBpmMax($max)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.bpm <= :max')
            ->setParameter('max', $max)
            ->orderBy('d.updatedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByBpm($min, $max)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.bpm <= :max AND d.bpm >= :min')
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->orderBy('d.updatedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

//    public function findByBpm(BeatSearch $beatSearch)
//    {
//
//        $query = $this->createQueryBuilder('d');
//
//        if ($beatSearch->getBeatBpmMax()){
//            $query->andWhere('d.bpm <= :bmax')
//                ->setParameter('bmax', $beatSearch->getBeatBpmMax())
//            ;
//            dd($beatSearch->getBeatBpmMax());
//        }
//
//        if ($beatSearch->getBeatBpmMin()){
//            $query->andWhere('d.bpm >= :bmin')
//                ->setParameter('bmin', $beatSearch->getBeatBpmMin())
//            ;
//        }
//
//        $query->orderBy('d.updatedAt', 'DESC')
//                ->getQuery()
//                ->getResult();
//
//        return $query;
//    }


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
