<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DriverApiTest extends TestCase
{
    use MakeDriverTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDriver()
    {
        $driver = $this->fakeDriverData();
        $this->json('POST', '/api/v1/drivers', $driver);

        $this->assertApiResponse($driver);
    }

    /**
     * @test
     */
    public function testReadDriver()
    {
        $driver = $this->makeDriver();
        $this->json('GET', '/api/v1/drivers/'.$driver->id);

        $this->assertApiResponse($driver->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDriver()
    {
        $driver = $this->makeDriver();
        $editedDriver = $this->fakeDriverData();

        $this->json('PUT', '/api/v1/drivers/'.$driver->id, $editedDriver);

        $this->assertApiResponse($editedDriver);
    }

    /**
     * @test
     */
    public function testDeleteDriver()
    {
        $driver = $this->makeDriver();
        $this->json('DELETE', '/api/v1/drivers/'.$driver->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/drivers/'.$driver->id);

        $this->assertResponseStatus(404);
    }
}
