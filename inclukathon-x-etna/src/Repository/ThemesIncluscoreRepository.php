<?php

namespace App\Repository;

use App\Entity\ThemesIncluscore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ThemesIncluscore>
 *
 * @method ThemesIncluscore|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThemesIncluscore|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThemesIncluscore[]    findAll()
 * @method ThemesIncluscore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemesIncluscoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThemesIncluscore::class);
    }

    public function save(ThemesIncluscore $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ThemesIncluscore $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ThemesIncluscore[] Returns an array of ThemesIncluscore objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ThemesIncluscore
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
