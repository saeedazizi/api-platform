<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Car;

class ReviewTest extends ApiTestCase
{
    public function testCreateReview(): void
    {
        static::createClient()->request('POST', '/cars', ['json' => [
            'brand' => 'Pride',
            'model' => 'ELX',
            'color' => 'red'
        ]]);

        $Iri = $this->findIriBy(Car::class, []);

        static::createClient()->request('POST', '/reviews', ['json' => [
            'starRating' => 9,
            'reviewText' => 'This is a test',
            'car' => $Iri
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([
            '@context' => '/contexts/Review',
            '@type' => 'Review',
            'starRating' => 9,
            'reviewText' => 'This is a test',
            'car' => $Iri
        ]);
    }

    public function testShowReview(): void
    {
        static::createClient()->request('POST', '/cars', ['json' => [
            'brand' => 'Pride',
            'model' => 'ELX',
            'color' => 'red'
        ]]);

        $Iri = $this->findIriBy(Car::class, []);

        static::createClient()->request('POST', '/reviews', ['json' => [
            'starRating' => 9,
            'reviewText' => 'This is a test',
            'car' => $Iri
        ]]);

        static::createClient()->request('GET', '/reviews');

        $this->assertResponseStatusCodeSame(200);
    }
}
