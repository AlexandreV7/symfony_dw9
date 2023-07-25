<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voiture>
 *
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Voiture::class);
    }

    /**
     * @return Voiture[] Returns an array of Voiture objects
     */
    public function recupererLesVoituresQueJeVeux($km): array {
        return $this
            ->createQueryBuilder('v')
            ->andWhere('v.km < :km')
            ->setParameter('km', $km)
            ->andWhere('v.marque IN (:marques)')
            ->setParameter('marques', ['Peugeot', 'Renault'])
            ->leftJoin('v.utilisateur', 'u')
            ->andWhere('u IS NULL')
            ->orderBy('v.km', 'DESC')
            ->getQuery()
            ->getResult();
    }

    function findAllAvecUtilisateurs() {
        return $this->createQueryBuilder('v')
            ->leftJoin('v.utilisateur', 'u')
            ->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?Voiture
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
