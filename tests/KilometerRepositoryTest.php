<?php

use App\Models\Kilometer;
use App\Repositories\KilometerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KilometerRepositoryTest extends TestCase
{
    use MakeKilometerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var KilometerRepository
     */
    protected $kilometerRepo;

    public function setUp()
    {
        parent::setUp();
        $this->kilometerRepo = App::make(KilometerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateKilometer()
    {
        $kilometer = $this->fakeKilometerData();
        $createdKilometer = $this->kilometerRepo->create($kilometer);
        $createdKilometer = $createdKilometer->toArray();
        $this->assertArrayHasKey('id', $createdKilometer);
        $this->assertNotNull($createdKilometer['id'], 'Created Kilometer must have id specified');
        $this->assertNotNull(Kilometer::find($createdKilometer['id']), 'Kilometer with given id must be in DB');
        $this->assertModelData($kilometer, $createdKilometer);
    }

    /**
     * @test read
     */
    public function testReadKilometer()
    {
        $kilometer = $this->makeKilometer();
        $dbKilometer = $this->kilometerRepo->find($kilometer->id);
        $dbKilometer = $dbKilometer->toArray();
        $this->assertModelData($kilometer->toArray(), $dbKilometer);
    }

    /**
     * @test update
     */
    public function testUpdateKilometer()
    {
        $kilometer = $this->makeKilometer();
        $fakeKilometer = $this->fakeKilometerData();
        $updatedKilometer = $this->kilometerRepo->update($fakeKilometer, $kilometer->id);
        $this->assertModelData($fakeKilometer, $updatedKilometer->toArray());
        $dbKilometer = $this->kilometerRepo->find($kilometer->id);
        $this->assertModelData($fakeKilometer, $dbKilometer->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteKilometer()
    {
        $kilometer = $this->makeKilometer();
        $resp = $this->kilometerRepo->delete($kilometer->id);
        $this->assertTrue($resp);
        $this->assertNull(Kilometer::find($kilometer->id), 'Kilometer should not exist in DB');
    }
}
