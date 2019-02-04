<?php

namespace App\Repository;

use App\Entity\Liurldata;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Liurldata|null find($id, $lockMode = null, $lockVersion = null)
 * @method Liurldata|null findOneBy(array $criteria, array $orderBy = null)
 * @method Liurldata[]    findAll()
 * @method Liurldata[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LiurldataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Liurldata::class);
    }

    // /**
    //  * @return Liurldata[] Returns an array of Liurldata objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Liurldata
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
