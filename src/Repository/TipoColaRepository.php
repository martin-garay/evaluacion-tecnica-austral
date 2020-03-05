<?php

namespace App\Repository;

use App\Entity\TipoCola;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoCola|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoCola|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoCola[]    findAll()
 * @method TipoCola[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoColaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoCola::class);
    }

    // /**
    //  * @return TipoCola[] Returns an array of TipoCola objects
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
    public function findOneBySomeField($value): ?TipoCola
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
