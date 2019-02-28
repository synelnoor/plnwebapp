<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CabangApiTest extends TestCase
{
    use MakeCabangTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCabang()
    {
        $cabang = $this->fakeCabangData();
        $this->json('POST', '/api/v1/cabangs', $cabang);

        $this->assertApiResponse($cabang);
    }

    /**
     * @test
     */
    public function testReadCabang()
    {
        $cabang = $this->makeCabang();
        $this->json('GET', '/api/v1/cabangs/'.$cabang->id);

        $this->assertApiResponse($cabang->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCabang()
    {
        $cabang = $this->makeCabang();
        $editedCabang = $this->fakeCabangData();

        $this->json('PUT', '/api/v1/cabangs/'.$cabang->id, $editedCabang);

        $this->assertApiResponse($editedCabang);
    }

    /**
     * @test
     */
    public function testDeleteCabang()
    {
        $cabang = $this->makeCabang();
        $this->json('DELETE', '/api/v1/cabangs/'.$cabang->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/cabangs/'.$cabang->id);

        $this->assertResponseStatus(404);
    }
}
