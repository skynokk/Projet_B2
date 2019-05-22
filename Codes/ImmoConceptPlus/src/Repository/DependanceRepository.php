<?php

namespace App\Repository;

use App\Entity\Dependance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dependance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dependance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dependance[]    findAll()
 * @method Dependance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DependanceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dependance::class);
    }

    // /**
    //  * @return Dependance[] Returns an array of Dependance objects
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
    public function findOneBySomeField($value): ?Dependance
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
