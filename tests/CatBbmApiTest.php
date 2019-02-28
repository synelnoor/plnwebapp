<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CatBbmApiTest extends TestCase
{
    use MakeCatBbmTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCatBbm()
    {
        $catBbm = $this->fakeCatBbmData();
        $this->json('POST', '/api/v1/catBbms', $catBbm);

        $this->assertApiResponse($catBbm);
    }

    /**
     * @test
     */
    public function testReadCatBbm()
    {
        $catBbm = $this->makeCatBbm();
        $this->json('GET', '/api/v1/catBbms/'.$catBbm->id);

        $this->assertApiResponse($catBbm->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCatBbm()
    {
        $catBbm = $this->makeCatBbm();
        $editedCatBbm = $this->fakeCatBbmData();

        $this->json('PUT', '/api/v1/catBbms/'.$catBbm->id, $editedCatBbm);

        $this->assertApiResponse($editedCatBbm);
    }

    /**
     * @test
     */
    public function testDeleteCatBbm()
    {
        $catBbm = $this->makeCatBbm();
        $this->json('DELETE', '/api/v1/catBbms/'.$catBbm->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/catBbms/'.$catBbm->id);

        $this->assertResponseStatus(404);
    }
}
