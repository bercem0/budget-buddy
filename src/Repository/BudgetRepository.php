<?php

namespace App\Repository;

use App\Entity\Budget;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Budget>
 */
class BudgetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        // Roep de parent constructor aan en geef aan dat deze repository voor Budget entity is
        parent::__construct($registry, Budget::class);
    }

    // Voorbeeld methodes die Symfony automatisch genereert.
    // Je kunt ze gebruiken als referentie om specifieke queries te maken.

//    /**
//     * @return Budget[] Returns an array of Budget objects
//     */
//    public function findByExampleField($value): array
//    {
//        // Voorbeeld van zoeken op een veld
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Budget
//    {
//        // Voorbeeld van zoeken naar één resultaat op een veld
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
