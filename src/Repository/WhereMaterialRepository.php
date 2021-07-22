<?php

namespace App\Repository;

use App\Entity\WhereMaterial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WhereMaterial|null find($id, $lockMode = null, $lockVersion = null)
 * @method WhereMaterial|null findOneBy(array $criteria, array $orderBy = null)
 * @method WhereMaterial[]    findAll()
 * @method WhereMaterial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WhereMaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WhereMaterial::class);
    }

    // /**
    //  * @return WhereMaterial[] Returns an array of WhereMaterial objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WhereMaterial
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
