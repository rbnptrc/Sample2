<?php

namespace App\Repository;

use App\Entity\Mushroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method null|Mushroom find($id, $lockMode = null, $lockVersion = null)
 * @method null|Mushroom findOneBy(array $criteria, array $orderBy = null)
 * @method Mushroom[]    findAll()
 * @method Mushroom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MushroomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mushroom::class);
    }

    // /**
    //  * @return Mushroom[] Returns an array of Mushroom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mushroom
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
