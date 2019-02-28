<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BbmApiTest extends TestCase
{
    use MakeBbmTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBbm()
    {
        $bbm = $this->fakeBbmData();
        $this->json('POST', '/api/v1/bbms', $bbm);

        $this->assertApiResponse($bbm);
    }

    /**
     * @test
     */
    public function testReadBbm()
    {
        $bbm = $this->makeBbm();
        $this->json('GET', '/api/v1/bbms/'.$bbm->id);

        $this->assertApiResponse($bbm->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBbm()
    {
        $bbm = $this->makeBbm();
        $editedBbm = $this->fakeBbmData();

        $this->json('PUT', '/api/v1/bbms/'.$bbm->id, $editedBbm);

        $this->assertApiResponse($editedBbm);
    }

    /**
     * @test
     */
    public function testDeleteBbm()
    {
        $bbm = $this->makeBbm();
        $this->json('DELETE', '/api/v1/bbms/'.$bbm->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/bbms/'.$bbm->id);

        $this->assertResponseStatus(404);
    }
}
