<?php

use App\Models\Bbm;
use App\Repositories\BbmRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BbmRepositoryTest extends TestCase
{
    use MakeBbmTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BbmRepository
     */
    protected $bbmRepo;

    public function setUp()
    {
        parent::setUp();
        $this->bbmRepo = App::make(BbmRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBbm()
    {
        $bbm = $this->fakeBbmData();
        $createdBbm = $this->bbmRepo->create($bbm);
        $createdBbm = $createdBbm->toArray();
        $this->assertArrayHasKey('id', $createdBbm);
        $this->assertNotNull($createdBbm['id'], 'Created Bbm must have id specified');
        $this->assertNotNull(Bbm::find($createdBbm['id']), 'Bbm with given id must be in DB');
        $this->assertModelData($bbm, $createdBbm);
    }

    /**
     * @test read
     */
    public function testReadBbm()
    {
        $bbm = $this->makeBbm();
        $dbBbm = $this->bbmRepo->find($bbm->id);
        $dbBbm = $dbBbm->toArray();
        $this->assertModelData($bbm->toArray(), $dbBbm);
    }

    /**
     * @test update
     */
    public function testUpdateBbm()
    {
        $bbm = $this->makeBbm();
        $fakeBbm = $this->fakeBbmData();
        $updatedBbm = $this->bbmRepo->update($fakeBbm, $bbm->id);
        $this->assertModelData($fakeBbm, $updatedBbm->toArray());
        $dbBbm = $this->bbmRepo->find($bbm->id);
        $this->assertModelData($fakeBbm, $dbBbm->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBbm()
    {
        $bbm = $this->makeBbm();
        $resp = $this->bbmRepo->delete($bbm->id);
        $this->assertTrue($resp);
        $this->assertNull(Bbm::find($bbm->id), 'Bbm should not exist in DB');
    }
}
