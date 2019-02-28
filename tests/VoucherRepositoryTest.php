<?php

use App\Models\Voucher;
use App\Repositories\VoucherRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VoucherRepositoryTest extends TestCase
{
    use MakeVoucherTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var VoucherRepository
     */
    protected $voucherRepo;

    public function setUp()
    {
        parent::setUp();
        $this->voucherRepo = App::make(VoucherRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateVoucher()
    {
        $voucher = $this->fakeVoucherData();
        $createdVoucher = $this->voucherRepo->create($voucher);
        $createdVoucher = $createdVoucher->toArray();
        $this->assertArrayHasKey('id', $createdVoucher);
        $this->assertNotNull($createdVoucher['id'], 'Created Voucher must have id specified');
        $this->assertNotNull(Voucher::find($createdVoucher['id']), 'Voucher with given id must be in DB');
        $this->assertModelData($voucher, $createdVoucher);
    }

    /**
     * @test read
     */
    public function testReadVoucher()
    {
        $voucher = $this->makeVoucher();
        $dbVoucher = $this->voucherRepo->find($voucher->id);
        $dbVoucher = $dbVoucher->toArray();
        $this->assertModelData($voucher->toArray(), $dbVoucher);
    }

    /**
     * @test update
     */
    public function testUpdateVoucher()
    {
        $voucher = $this->makeVoucher();
        $fakeVoucher = $this->fakeVoucherData();
        $updatedVoucher = $this->voucherRepo->update($fakeVoucher, $voucher->id);
        $this->assertModelData($fakeVoucher, $updatedVoucher->toArray());
        $dbVoucher = $this->voucherRepo->find($voucher->id);
        $this->assertModelData($fakeVoucher, $dbVoucher->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteVoucher()
    {
        $voucher = $this->makeVoucher();
        $resp = $this->voucherRepo->delete($voucher->id);
        $this->assertTrue($resp);
        $this->assertNull(Voucher::find($voucher->id), 'Voucher should not exist in DB');
    }
}
