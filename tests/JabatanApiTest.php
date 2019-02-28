<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JabatanApiTest extends TestCase
{
    use MakeJabatanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateJabatan()
    {
        $jabatan = $this->fakeJabatanData();
        $this->json('POST', '/api/v1/jabatans', $jabatan);

        $this->assertApiResponse($jabatan);
    }

    /**
     * @test
     */
    public function testReadJabatan()
    {
        $jabatan = $this->makeJabatan();
        $this->json('GET', '/api/v1/jabatans/'.$jabatan->id);

        $this->assertApiResponse($jabatan->toArray());
    }

    /**
     * @test
     */
    public function testUpdateJabatan()
    {
        $jabatan = $this->makeJabatan();
        $editedJabatan = $this->fakeJabatanData();

        $this->json('PUT', '/api/v1/jabatans/'.$jabatan->id, $editedJabatan);

        $this->assertApiResponse($editedJabatan);
    }

    /**
     * @test
     */
    public function testDeleteJabatan()
    {
        $jabatan = $this->makeJabatan();
        $this->json('DELETE', '/api/v1/jabatans/'.$jabatan->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/jabatans/'.$jabatan->id);

        $this->assertResponseStatus(404);
    }
}
