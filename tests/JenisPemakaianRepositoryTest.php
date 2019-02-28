<?php

use App\Models\JenisPemakaian;
use App\Repositories\JenisPemakaianRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JenisPemakaianRepositoryTest extends TestCase
{
    use MakeJenisPemakaianTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var JenisPemakaianRepository
     */
    protected $jenisPemakaianRepo;

    public function setUp()
    {
        parent::setUp();
        $this->jenisPemakaianRepo = App::make(JenisPemakaianRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateJenisPemakaian()
    {
        $jenisPemakaian = $this->fakeJenisPemakaianData();
        $createdJenisPemakaian = $this->jenisPemakaianRepo->create($jenisPemakaian);
        $createdJenisPemakaian = $createdJenisPemakaian->toArray();
        $this->assertArrayHasKey('id', $createdJenisPemakaian);
        $this->assertNotNull($createdJenisPemakaian['id'], 'Created JenisPemakaian must have id specified');
        $this->assertNotNull(JenisPemakaian::find($createdJenisPemakaian['id']), 'JenisPemakaian with given id must be in DB');
        $this->assertModelData($jenisPemakaian, $createdJenisPemakaian);
    }

    /**
     * @test read
     */
    public function testReadJenisPemakaian()
    {
        $jenisPemakaian = $this->makeJenisPemakaian();
        $dbJenisPemakaian = $this->jenisPemakaianRepo->find($jenisPemakaian->id);
        $dbJenisPemakaian = $dbJenisPemakaian->toArray();
        $this->assertModelData($jenisPemakaian->toArray(), $dbJenisPemakaian);
    }

    /**
     * @test update
     */
    public function testUpdateJenisPemakaian()
    {
        $jenisPemakaian = $this->makeJenisPemakaian();
        $fakeJenisPemakaian = $this->fakeJenisPemakaianData();
        $updatedJenisPemakaian = $this->jenisPemakaianRepo->update($fakeJenisPemakaian, $jenisPemakaian->id);
        $this->assertModelData($fakeJenisPemakaian, $updatedJenisPemakaian->toArray());
        $dbJenisPemakaian = $this->jenisPemakaianRepo->find($jenisPemakaian->id);
        $this->assertModelData($fakeJenisPemakaian, $dbJenisPemakaian->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteJenisPemakaian()
    {
        $jenisPemakaian = $this->makeJenisPemakaian();
        $resp = $this->jenisPemakaianRepo->delete($jenisPemakaian->id);
        $this->assertTrue($resp);
        $this->assertNull(JenisPemakaian::find($jenisPemakaian->id), 'JenisPemakaian should not exist in DB');
    }
}
