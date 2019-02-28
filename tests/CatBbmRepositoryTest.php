<?php

use App\Models\CatBbm;
use App\Repositories\CatBbmRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CatBbmRepositoryTest extends TestCase
{
    use MakeCatBbmTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CatBbmRepository
     */
    protected $catBbmRepo;

    public function setUp()
    {
        parent::setUp();
        $this->catBbmRepo = App::make(CatBbmRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCatBbm()
    {
        $catBbm = $this->fakeCatBbmData();
        $createdCatBbm = $this->catBbmRepo->create($catBbm);
        $createdCatBbm = $createdCatBbm->toArray();
        $this->assertArrayHasKey('id', $createdCatBbm);
        $this->assertNotNull($createdCatBbm['id'], 'Created CatBbm must have id specified');
        $this->assertNotNull(CatBbm::find($createdCatBbm['id']), 'CatBbm with given id must be in DB');
        $this->assertModelData($catBbm, $createdCatBbm);
    }

    /**
     * @test read
     */
    public function testReadCatBbm()
    {
        $catBbm = $this->makeCatBbm();
        $dbCatBbm = $this->catBbmRepo->find($catBbm->id);
        $dbCatBbm = $dbCatBbm->toArray();
        $this->assertModelData($catBbm->toArray(), $dbCatBbm);
    }

    /**
     * @test update
     */
    public function testUpdateCatBbm()
    {
        $catBbm = $this->makeCatBbm();
        $fakeCatBbm = $this->fakeCatBbmData();
        $updatedCatBbm = $this->catBbmRepo->update($fakeCatBbm, $catBbm->id);
        $this->assertModelData($fakeCatBbm, $updatedCatBbm->toArray());
        $dbCatBbm = $this->catBbmRepo->find($catBbm->id);
        $this->assertModelData($fakeCatBbm, $dbCatBbm->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCatBbm()
    {
        $catBbm = $this->makeCatBbm();
        $resp = $this->catBbmRepo->delete($catBbm->id);
        $this->assertTrue($resp);
        $this->assertNull(CatBbm::find($catBbm->id), 'CatBbm should not exist in DB');
    }
}
