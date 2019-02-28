<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LapSuratJalanApiTest extends TestCase
{
    use MakeLapSuratJalanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateLapSuratJalan()
    {
        $lapSuratJalan = $this->fakeLapSuratJalanData();
        $this->json('POST', '/api/v1/lapSuratJalans', $lapSuratJalan);

        $this->assertApiResponse($lapSuratJalan);
    }

    /**
     * @test
     */
    public function testReadLapSuratJalan()
    {
        $lapSuratJalan = $this->makeLapSuratJalan();
        $this->json('GET', '/api/v1/lapSuratJalans/'.$lapSuratJalan->id);

        $this->assertApiResponse($lapSuratJalan->toArray());
    }

    /**
     * @test
     */
    public function testUpdateLapSuratJalan()
    {
        $lapSuratJalan = $this->makeLapSuratJalan();
        $editedLapSuratJalan = $this->fakeLapSuratJalanData();

        $this->json('PUT', '/api/v1/lapSuratJalans/'.$lapSuratJalan->id, $editedLapSuratJalan);

        $this->assertApiResponse($editedLapSuratJalan);
    }

    /**
     * @test
     */
    public function testDeleteLapSuratJalan()
    {
        $lapSuratJalan = $this->makeLapSuratJalan();
        $this->json('DELETE', '/api/v1/lapSuratJalans/'.$lapSuratJalan->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/lapSuratJalans/'.$lapSuratJalan->id);

        $this->assertResponseStatus(404);
    }
}
