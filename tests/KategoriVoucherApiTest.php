<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KategoriVoucherApiTest extends TestCase
{
    use MakeKategoriVoucherTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateKategoriVoucher()
    {
        $kategoriVoucher = $this->fakeKategoriVoucherData();
        $this->json('POST', '/api/v1/kategoriVouchers', $kategoriVoucher);

        $this->assertApiResponse($kategoriVoucher);
    }

    /**
     * @test
     */
    public function testReadKategoriVoucher()
    {
        $kategoriVoucher = $this->makeKategoriVoucher();
        $this->json('GET', '/api/v1/kategoriVouchers/'.$kategoriVoucher->id);

        $this->assertApiResponse($kategoriVoucher->toArray());
    }

    /**
     * @test
     */
    public function testUpdateKategoriVoucher()
    {
        $kategoriVoucher = $this->makeKategoriVoucher();
        $editedKategoriVoucher = $this->fakeKategoriVoucherData();

        $this->json('PUT', '/api/v1/kategoriVouchers/'.$kategoriVoucher->id, $editedKategoriVoucher);

        $this->assertApiResponse($editedKategoriVoucher);
    }

    /**
     * @test
     */
    public function testDeleteKategoriVoucher()
    {
        $kategoriVoucher = $this->makeKategoriVoucher();
        $this->json('DELETE', '/api/v1/kategoriVouchers/'.$kategoriVoucher->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/kategoriVouchers/'.$kategoriVoucher->id);

        $this->assertResponseStatus(404);
    }
}
