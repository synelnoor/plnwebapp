<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KilometerApiTest extends TestCase
{
    use MakeKilometerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateKilometer()
    {
        $kilometer = $this->fakeKilometerData();
        $this->json('POST', '/api/v1/kilometers', $kilometer);

        $this->assertApiResponse($kilometer);
    }

    /**
     * @test
     */
    public function testReadKilometer()
    {
        $kilometer = $this->makeKilometer();
        $this->json('GET', '/api/v1/kilometers/'.$kilometer->id);

        $this->assertApiResponse($kilometer->toArray());
    }

    /**
     * @test
     */
    public function testUpdateKilometer()
    {
        $kilometer = $this->makeKilometer();
        $editedKilometer = $this->fakeKilometerData();

        $this->json('PUT', '/api/v1/kilometers/'.$kilometer->id, $editedKilometer);

        $this->assertApiResponse($editedKilometer);
    }

    /**
     * @test
     */
    public function testDeleteKilometer()
    {
        $kilometer = $this->makeKilometer();
        $this->json('DELETE', '/api/v1/kilometers/'.$kilometer->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/kilometers/'.$kilometer->id);

        $this->assertResponseStatus(404);
    }
}
