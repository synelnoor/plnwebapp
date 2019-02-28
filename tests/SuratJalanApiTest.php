<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SuratJalanApiTest extends TestCase
{
    use MakeSuratJalanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSuratJalan()
    {
        $suratJalan = $this->fakeSuratJalanData();
        $this->json('POST', '/api/v1/suratJalans', $suratJalan);

        $this->assertApiResponse($suratJalan);
    }

    /**
     * @test
     */
    public function testReadSuratJalan()
    {
        $suratJalan = $this->makeSuratJalan();
        $this->json('GET', '/api/v1/suratJalans/'.$suratJalan->id);

        $this->assertApiResponse($suratJalan->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSuratJalan()
    {
        $suratJalan = $this->makeSuratJalan();
        $editedSuratJalan = $this->fakeSuratJalanData();

        $this->json('PUT', '/api/v1/suratJalans/'.$suratJalan->id, $editedSuratJalan);

        $this->assertApiResponse($editedSuratJalan);
    }

    /**
     * @test
     */
    public function testDeleteSuratJalan()
    {
        $suratJalan = $this->makeSuratJalan();
        $this->json('DELETE', '/api/v1/suratJalans/'.$suratJalan->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/suratJalans/'.$suratJalan->id);

        $this->assertResponseStatus(404);
    }
}
