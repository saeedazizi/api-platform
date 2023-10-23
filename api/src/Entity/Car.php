<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Controller\CarController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(mercure: true)]
#[ApiResource(
    operations: [new Get(
        uriTemplate: '/cars/{id}/reviews/last-five-popular',
        controller: CarController::class,
        name: 'last-five-popular-reviews',
    )],
)]
#[ORM\Entity]
#[ORM\Table(name: 'cars')]
class Car
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?string $brand;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?string $model;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?string $color;

    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'car', cascade: ['persist', 'remove'])]
    private Collection $reviews;

    public function __construct()
    {
        $this->id = null;
        $this->brand = null;
        $this->model = null;
        $this->color = null;
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function addReview(Review $review): self
    {
        $this->reviews[] = $review;
        $review->setCar($this);

        return $this;
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }
}
