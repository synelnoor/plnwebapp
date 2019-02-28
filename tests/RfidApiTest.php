<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RfidApiTest extends TestCase
{
    use MakeRfidTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRfid()
    {
        $rfid = $this->fakeRfidData();
        $this->json('POST', '/api/v1/rfids', $rfid);

        $this->assertApiResponse($rfid);
    }

    /**
     * @test
     */
    public function testReadRfid()
    {
        $rfid = $this->makeRfid();
        $this->json('GET', '/api/v1/rfids/'.$rfid->id);

        $this->assertApiResponse($rfid->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRfid()
    {
        $rfid = $this->makeRfid();
        $editedRfid = $this->fakeRfidData();

        $this->json('PUT', '/api/v1/rfids/'.$rfid->id, $editedRfid);

        $this->assertApiResponse($editedRfid);
    }

    /**
     * @test
     */
    public function testDeleteRfid()
    {
        $rfid = $this->makeRfid();
        $this->json('DELETE', '/api/v1/rfids/'.$rfid->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/rfids/'.$rfid->id);

        $this->assertResponseStatus(404);
    }
}
