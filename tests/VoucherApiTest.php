<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VoucherApiTest extends TestCase
{
    use MakeVoucherTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateVoucher()
    {
        $voucher = $this->fakeVoucherData();
        $this->json('POST', '/api/v1/vouchers', $voucher);

        $this->assertApiResponse($voucher);
    }

    /**
     * @test
     */
    public function testReadVoucher()
    {
        $voucher = $this->makeVoucher();
        $this->json('GET', '/api/v1/vouchers/'.$voucher->id);

        $this->assertApiResponse($voucher->toArray());
    }

    /**
     * @test
     */
    public function testUpdateVoucher()
    {
        $voucher = $this->makeVoucher();
        $editedVoucher = $this->fakeVoucherData();

        $this->json('PUT', '/api/v1/vouchers/'.$voucher->id, $editedVoucher);

        $this->assertApiResponse($editedVoucher);
    }

    /**
     * @test
     */
    public function testDeleteVoucher()
    {
        $voucher = $this->makeVoucher();
        $this->json('DELETE', '/api/v1/vouchers/'.$voucher->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/vouchers/'.$voucher->id);

        $this->assertResponseStatus(404);
    }
}
