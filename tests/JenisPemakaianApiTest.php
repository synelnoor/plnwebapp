<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JenisPemakaianApiTest extends TestCase
{
    use MakeJenisPemakaianTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateJenisPemakaian()
    {
        $jenisPemakaian = $this->fakeJenisPemakaianData();
        $this->json('POST', '/api/v1/jenisPemakaians', $jenisPemakaian);

        $this->assertApiResponse($jenisPemakaian);
    }

    /**
     * @test
     */
    public function testReadJenisPemakaian()
    {
        $jenisPemakaian = $this->makeJenisPemakaian();
        $this->json('GET', '/api/v1/jenisPemakaians/'.$jenisPemakaian->id);

        $this->assertApiResponse($jenisPemakaian->toArray());
    }

    /**
     * @test
     */
    public function testUpdateJenisPemakaian()
    {
        $jenisPemakaian = $this->makeJenisPemakaian();
        $editedJenisPemakaian = $this->fakeJenisPemakaianData();

        $this->json('PUT', '/api/v1/jenisPemakaians/'.$jenisPemakaian->id, $editedJenisPemakaian);

        $this->assertApiResponse($editedJenisPemakaian);
    }

    /**
     * @test
     */
    public function testDeleteJenisPemakaian()
    {
        $jenisPemakaian = $this->makeJenisPemakaian();
        $this->json('DELETE', '/api/v1/jenisPemakaians/'.$jenisPemakaian->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/jenisPemakaians/'.$jenisPemakaian->id);

        $this->assertResponseStatus(404);
    }
}
