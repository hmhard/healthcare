<?php

namespace App\Repository;

use App\Entity\DepartmentHead;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DepartmentHead|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepartmentHead|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepartmentHead[]    findAll()
 * @method DepartmentHead[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartmentHeadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepartmentHead::class);
    }

    // /**
    //  * @return DepartmentHead[] Returns an array of DepartmentHead objects
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
    public function findOneBySomeField($value): ?DepartmentHead
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
