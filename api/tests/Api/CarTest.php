<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Car;

class CarTest extends ApiTestCase
{
    public function testCreateCar(): void
    {
        static::createClient()->request('POST', '/cars', ['json' => [
            'brand' => 'Pride',
            'model' => 'ELX',
            'color' => 'red'
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([
            '@context' => '/contexts/Car',
            '@type' => 'Car',
            'brand' => 'Pride',
            'model' => 'ELX',
            'color' => 'red'
        ]);
    }

    public function testLastFivePopular(): void
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

        static::createClient()->request('GET', $Iri . '/reviews/last-five-popular');

        $this->assertResponseStatusCodeSame(200);
    }
}
