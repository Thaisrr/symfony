<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    public function search($needle)
    {
        return $this->createQueryBuilder('l')
            ->where('l.titre LIKE :needle')
            ->setParameter('needle', '%'.$needle.'%')
            ->getQuery()
            ->getResult();
    }

    public function findLivreByParution()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT l FROM App\Entity\livre l WHERE l.parution > :date") // si on voulait nommer les champs, il faudrait faire l.id,...
            ->setParameter('date', '2000-01-01')
            ->getResult();
    }

    public function findAllJoinAuteur()
    {
        return $this->createQueryBuilder('l')
            ->select('l, a')
            ->join('l.auteur', 'a')
            ->setParameter('date', '2000-01-01')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
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
    public function findOneBySomeField($value): ?Livre
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
