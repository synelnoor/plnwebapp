<?php

use App\Models\Driver;
use App\Repositories\DriverRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DriverRepositoryTest extends TestCase
{
    use MakeDriverTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DriverRepository
     */
    protected $driverRepo;

    public function setUp()
    {
        parent::setUp();
        $this->driverRepo = App::make(DriverRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDriver()
    {
        $driver = $this->fakeDriverData();
        $createdDriver = $this->driverRepo->create($driver);
        $createdDriver = $createdDriver->toArray();
        $this->assertArrayHasKey('id', $createdDriver);
        $this->assertNotNull($createdDriver['id'], 'Created Driver must have id specified');
        $this->assertNotNull(Driver::find($createdDriver['id']), 'Driver with given id must be in DB');
        $this->assertModelData($driver, $createdDriver);
    }

    /**
     * @test read
     */
    public function testReadDriver()
    {
        $driver = $this->makeDriver();
        $dbDriver = $this->driverRepo->find($driver->id);
        $dbDriver = $dbDriver->toArray();
        $this->assertModelData($driver->toArray(), $dbDriver);
    }

    /**
     * @test update
     */
    public function testUpdateDriver()
    {
        $driver = $this->makeDriver();
        $fakeDriver = $this->fakeDriverData();
        $updatedDriver = $this->driverRepo->update($fakeDriver, $driver->id);
        $this->assertModelData($fakeDriver, $updatedDriver->toArray());
        $dbDriver = $this->driverRepo->find($driver->id);
        $this->assertModelData($fakeDriver, $dbDriver->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDriver()
    {
        $driver = $this->makeDriver();
        $resp = $this->driverRepo->delete($driver->id);
        $this->assertTrue($resp);
        $this->assertNull(Driver::find($driver->id), 'Driver should not exist in DB');
    }
}
