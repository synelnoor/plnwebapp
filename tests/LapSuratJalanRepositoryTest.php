<?php

use App\Models\LapSuratJalan;
use App\Repositories\LapSuratJalanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LapSuratJalanRepositoryTest extends TestCase
{
    use MakeLapSuratJalanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LapSuratJalanRepository
     */
    protected $lapSuratJalanRepo;

    public function setUp()
    {
        parent::setUp();
        $this->lapSuratJalanRepo = App::make(LapSuratJalanRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateLapSuratJalan()
    {
        $lapSuratJalan = $this->fakeLapSuratJalanData();
        $createdLapSuratJalan = $this->lapSuratJalanRepo->create($lapSuratJalan);
        $createdLapSuratJalan = $createdLapSuratJalan->toArray();
        $this->assertArrayHasKey('id', $createdLapSuratJalan);
        $this->assertNotNull($createdLapSuratJalan['id'], 'Created LapSuratJalan must have id specified');
        $this->assertNotNull(LapSuratJalan::find($createdLapSuratJalan['id']), 'LapSuratJalan with given id must be in DB');
        $this->assertModelData($lapSuratJalan, $createdLapSuratJalan);
    }

    /**
     * @test read
     */
    public function testReadLapSuratJalan()
    {
        $lapSuratJalan = $this->makeLapSuratJalan();
        $dbLapSuratJalan = $this->lapSuratJalanRepo->find($lapSuratJalan->id);
        $dbLapSuratJalan = $dbLapSuratJalan->toArray();
        $this->assertModelData($lapSuratJalan->toArray(), $dbLapSuratJalan);
    }

    /**
     * @test update
     */
    public function testUpdateLapSuratJalan()
    {
        $lapSuratJalan = $this->makeLapSuratJalan();
        $fakeLapSuratJalan = $this->fakeLapSuratJalanData();
        $updatedLapSuratJalan = $this->lapSuratJalanRepo->update($fakeLapSuratJalan, $lapSuratJalan->id);
        $this->assertModelData($fakeLapSuratJalan, $updatedLapSuratJalan->toArray());
        $dbLapSuratJalan = $this->lapSuratJalanRepo->find($lapSuratJalan->id);
        $this->assertModelData($fakeLapSuratJalan, $dbLapSuratJalan->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteLapSuratJalan()
    {
        $lapSuratJalan = $this->makeLapSuratJalan();
        $resp = $this->lapSuratJalanRepo->delete($lapSuratJalan->id);
        $this->assertTrue($resp);
        $this->assertNull(LapSuratJalan::find($lapSuratJalan->id), 'LapSuratJalan should not exist in DB');
    }
}
