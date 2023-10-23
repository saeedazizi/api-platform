<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CarController extends AbstractController
{
    public function __construct(private ReviewRepository $reviewRepository)
    {}

    public function __invoke(Car $car): JsonResponse
    {
        $result = $this->reviewRepository
            ->getLastFiveReviewsWithMoreThan6Rate(
                $car
            )
        ;

        return $this->json($result);
    }
}
