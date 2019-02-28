<?php

use App\Models\Rfid;
use App\Repositories\RfidRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RfidRepositoryTest extends TestCase
{
    use MakeRfidTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RfidRepository
     */
    protected $rfidRepo;

    public function setUp()
    {
        parent::setUp();
        $this->rfidRepo = App::make(RfidRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRfid()
    {
        $rfid = $this->fakeRfidData();
        $createdRfid = $this->rfidRepo->create($rfid);
        $createdRfid = $createdRfid->toArray();
        $this->assertArrayHasKey('id', $createdRfid);
        $this->assertNotNull($createdRfid['id'], 'Created Rfid must have id specified');
        $this->assertNotNull(Rfid::find($createdRfid['id']), 'Rfid with given id must be in DB');
        $this->assertModelData($rfid, $createdRfid);
    }

    /**
     * @test read
     */
    public function testReadRfid()
    {
        $rfid = $this->makeRfid();
        $dbRfid = $this->rfidRepo->find($rfid->id);
        $dbRfid = $dbRfid->toArray();
        $this->assertModelData($rfid->toArray(), $dbRfid);
    }

    /**
     * @test update
     */
    public function testUpdateRfid()
    {
        $rfid = $this->makeRfid();
        $fakeRfid = $this->fakeRfidData();
        $updatedRfid = $this->rfidRepo->update($fakeRfid, $rfid->id);
        $this->assertModelData($fakeRfid, $updatedRfid->toArray());
        $dbRfid = $this->rfidRepo->find($rfid->id);
        $this->assertModelData($fakeRfid, $dbRfid->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRfid()
    {
        $rfid = $this->makeRfid();
        $resp = $this->rfidRepo->delete($rfid->id);
        $this->assertTrue($resp);
        $this->assertNull(Rfid::find($rfid->id), 'Rfid should not exist in DB');
    }
}
