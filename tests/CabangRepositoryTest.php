<?php

use App\Models\Cabang;
use App\Repositories\CabangRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CabangRepositoryTest extends TestCase
{
    use MakeCabangTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CabangRepository
     */
    protected $cabangRepo;

    public function setUp()
    {
        parent::setUp();
        $this->cabangRepo = App::make(CabangRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCabang()
    {
        $cabang = $this->fakeCabangData();
        $createdCabang = $this->cabangRepo->create($cabang);
        $createdCabang = $createdCabang->toArray();
        $this->assertArrayHasKey('id', $createdCabang);
        $this->assertNotNull($createdCabang['id'], 'Created Cabang must have id specified');
        $this->assertNotNull(Cabang::find($createdCabang['id']), 'Cabang with given id must be in DB');
        $this->assertModelData($cabang, $createdCabang);
    }

    /**
     * @test read
     */
    public function testReadCabang()
    {
        $cabang = $this->makeCabang();
        $dbCabang = $this->cabangRepo->find($cabang->id);
        $dbCabang = $dbCabang->toArray();
        $this->assertModelData($cabang->toArray(), $dbCabang);
    }

    /**
     * @test update
     */
    public function testUpdateCabang()
    {
        $cabang = $this->makeCabang();
        $fakeCabang = $this->fakeCabangData();
        $updatedCabang = $this->cabangRepo->update($fakeCabang, $cabang->id);
        $this->assertModelData($fakeCabang, $updatedCabang->toArray());
        $dbCabang = $this->cabangRepo->find($cabang->id);
        $this->assertModelData($fakeCabang, $dbCabang->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCabang()
    {
        $cabang = $this->makeCabang();
        $resp = $this->cabangRepo->delete($cabang->id);
        $this->assertTrue($resp);
        $this->assertNull(Cabang::find($cabang->id), 'Cabang should not exist in DB');
    }
}
