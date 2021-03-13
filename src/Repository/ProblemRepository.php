<?php

namespace App\Repository;

use App\Entity\Problem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Problem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Problem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Problem[]    findAll()
 * @method Problem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProblemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Problem::class);
    }

  
    public function getData($user)
    {
        $qb= $this->createQueryBuilder('p');
        if($user->getUserType() && $user->getUserType()->getId()==2){
            $dept=[];
            foreach($user->getDepartmentHeads() as $d)
            $dept[]=$d->getDepartment();
            $qb->andWhere('p.department in (:department)')
            ->setParameter('department',$dept);
        }    
        if($user->getUserType() && $user->getUserType()->getId()==3){
       $qb ->andWhere('p.postedBy = :postedBy')
            ->setParameter('postedBy', $user);
        }
           return $qb ->orderBy('p.id', 'ASC')
            
            ->getQuery()
            ->getResult()
        ;
    }
   

    /*
    public function findOneBySomeField($value): ?Problem
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
