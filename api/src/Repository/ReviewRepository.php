<?php

namespace App\Repository;

use App\Entity\Car;
use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function getLastFiveReviewsWithMoreThan6Rate(Car $car): array
    {
        return $this->createQueryBuilder('r')
            ->where('r.car = :car')
            ->andWhere('r.starRating > 6')
            ->orderBy('r.id', 'DESC')
            ->setParameter('car', $car)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
}
