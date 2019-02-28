<?php

use App\Models\SuratJalan;
use App\Repositories\SuratJalanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SuratJalanRepositoryTest extends TestCase
{
    use MakeSuratJalanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SuratJalanRepository
     */
    protected $suratJalanRepo;

    public function setUp()
    {
        parent::setUp();
        $this->suratJalanRepo = App::make(SuratJalanRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSuratJalan()
    {
        $suratJalan = $this->fakeSuratJalanData();
        $createdSuratJalan = $this->suratJalanRepo->create($suratJalan);
        $createdSuratJalan = $createdSuratJalan->toArray();
        $this->assertArrayHasKey('id', $createdSuratJalan);
        $this->assertNotNull($createdSuratJalan['id'], 'Created SuratJalan must have id specified');
        $this->assertNotNull(SuratJalan::find($createdSuratJalan['id']), 'SuratJalan with given id must be in DB');
        $this->assertModelData($suratJalan, $createdSuratJalan);
    }

    /**
     * @test read
     */
    public function testReadSuratJalan()
    {
        $suratJalan = $this->makeSuratJalan();
        $dbSuratJalan = $this->suratJalanRepo->find($suratJalan->id);
        $dbSuratJalan = $dbSuratJalan->toArray();
        $this->assertModelData($suratJalan->toArray(), $dbSuratJalan);
    }

    /**
     * @test update
     */
    public function testUpdateSuratJalan()
    {
        $suratJalan = $this->makeSuratJalan();
        $fakeSuratJalan = $this->fakeSuratJalanData();
        $updatedSuratJalan = $this->suratJalanRepo->update($fakeSuratJalan, $suratJalan->id);
        $this->assertModelData($fakeSuratJalan, $updatedSuratJalan->toArray());
        $dbSuratJalan = $this->suratJalanRepo->find($suratJalan->id);
        $this->assertModelData($fakeSuratJalan, $dbSuratJalan->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSuratJalan()
    {
        $suratJalan = $this->makeSuratJalan();
        $resp = $this->suratJalanRepo->delete($suratJalan->id);
        $this->assertTrue($resp);
        $this->assertNull(SuratJalan::find($suratJalan->id), 'SuratJalan should not exist in DB');
    }
}
