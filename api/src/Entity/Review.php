<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(mercure: true)]

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ORM\Table(name: 'reviews')]
class Review
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id;

    #[ORM\Column(name: 'star_rating')]
    #[Assert\NotBlank]
    #[Assert\Range(
        notInRangeMessage: 'Rate should be between {{ min }} and {{ max }}',
        min: 0,
        max: 10,
    )]
    private ?int $starRating;

    #[ORM\Column(name: 'review_text')]
    #[Assert\NotBlank]
    private string $reviewText;

    #[ORM\ManyToOne(targetEntity: Car::class, inversedBy: 'reviews')]
    #[ORM\JoinColumn(name: 'car_id', referencedColumnName: 'id')]
    #[Assert\NotNull]
    private ?Car $car;

    public function __construct()
    {
        $this->id = null;
        $this->starRating = null;
        $this->reviewText = '';
        $this->car = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStarRating(): ?int
    {
        return $this->starRating;
    }

    public function setStarRating(int $starRating): self
    {
        $this->starRating = $starRating;

        return $this;
    }

    public function getReviewText(): string
    {
        return $this->reviewText;
    }

    public function setReviewText(string $reviewText): self
    {
        $this->reviewText = $reviewText;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(Car $car): self
    {
        $this->car = $car;

        return $this;
    }
}
