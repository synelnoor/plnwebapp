<?php

use App\Models\KategoriVoucher;
use App\Repositories\KategoriVoucherRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KategoriVoucherRepositoryTest extends TestCase
{
    use MakeKategoriVoucherTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var KategoriVoucherRepository
     */
    protected $kategoriVoucherRepo;

    public function setUp()
    {
        parent::setUp();
        $this->kategoriVoucherRepo = App::make(KategoriVoucherRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateKategoriVoucher()
    {
        $kategoriVoucher = $this->fakeKategoriVoucherData();
        $createdKategoriVoucher = $this->kategoriVoucherRepo->create($kategoriVoucher);
        $createdKategoriVoucher = $createdKategoriVoucher->toArray();
        $this->assertArrayHasKey('id', $createdKategoriVoucher);
        $this->assertNotNull($createdKategoriVoucher['id'], 'Created KategoriVoucher must have id specified');
        $this->assertNotNull(KategoriVoucher::find($createdKategoriVoucher['id']), 'KategoriVoucher with given id must be in DB');
        $this->assertModelData($kategoriVoucher, $createdKategoriVoucher);
    }

    /**
     * @test read
     */
    public function testReadKategoriVoucher()
    {
        $kategoriVoucher = $this->makeKategoriVoucher();
        $dbKategoriVoucher = $this->kategoriVoucherRepo->find($kategoriVoucher->id);
        $dbKategoriVoucher = $dbKategoriVoucher->toArray();
        $this->assertModelData($kategoriVoucher->toArray(), $dbKategoriVoucher);
    }

    /**
     * @test update
     */
    public function testUpdateKategoriVoucher()
    {
        $kategoriVoucher = $this->makeKategoriVoucher();
        $fakeKategoriVoucher = $this->fakeKategoriVoucherData();
        $updatedKategoriVoucher = $this->kategoriVoucherRepo->update($fakeKategoriVoucher, $kategoriVoucher->id);
        $this->assertModelData($fakeKategoriVoucher, $updatedKategoriVoucher->toArray());
        $dbKategoriVoucher = $this->kategoriVoucherRepo->find($kategoriVoucher->id);
        $this->assertModelData($fakeKategoriVoucher, $dbKategoriVoucher->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteKategoriVoucher()
    {
        $kategoriVoucher = $this->makeKategoriVoucher();
        $resp = $this->kategoriVoucherRepo->delete($kategoriVoucher->id);
        $this->assertTrue($resp);
        $this->assertNull(KategoriVoucher::find($kategoriVoucher->id), 'KategoriVoucher should not exist in DB');
    }
}
