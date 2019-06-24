<?php

namespace App\Repository;

use App\Entity\TypeTelephone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeTelephone|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeTelephone|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeTelephone[]    findAll()
 * @method TypeTelephone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeTelephoneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeTelephone::class);
    }

    // /**
    //  * @return TypeTelephone[] Returns an array of TypeTelephone objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeTelephone
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
