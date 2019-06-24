<?php

namespace App\Repository;

use App\Entity\Communiquer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Communiquer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Communiquer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Communiquer[]    findAll()
 * @method Communiquer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommuniquerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Communiquer::class);
    }

    // /**
    //  * @return Communiquer[] Returns an array of Communiquer objects
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
    public function findOneBySomeField($value): ?Communiquer
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
