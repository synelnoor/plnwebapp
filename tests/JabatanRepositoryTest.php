<?php

use App\Models\Jabatan;
use App\Repositories\JabatanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JabatanRepositoryTest extends TestCase
{
    use MakeJabatanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var JabatanRepository
     */
    protected $jabatanRepo;

    public function setUp()
    {
        parent::setUp();
        $this->jabatanRepo = App::make(JabatanRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateJabatan()
    {
        $jabatan = $this->fakeJabatanData();
        $createdJabatan = $this->jabatanRepo->create($jabatan);
        $createdJabatan = $createdJabatan->toArray();
        $this->assertArrayHasKey('id', $createdJabatan);
        $this->assertNotNull($createdJabatan['id'], 'Created Jabatan must have id specified');
        $this->assertNotNull(Jabatan::find($createdJabatan['id']), 'Jabatan with given id must be in DB');
        $this->assertModelData($jabatan, $createdJabatan);
    }

    /**
     * @test read
     */
    public function testReadJabatan()
    {
        $jabatan = $this->makeJabatan();
        $dbJabatan = $this->jabatanRepo->find($jabatan->id);
        $dbJabatan = $dbJabatan->toArray();
        $this->assertModelData($jabatan->toArray(), $dbJabatan);
    }

    /**
     * @test update
     */
    public function testUpdateJabatan()
    {
        $jabatan = $this->makeJabatan();
        $fakeJabatan = $this->fakeJabatanData();
        $updatedJabatan = $this->jabatanRepo->update($fakeJabatan, $jabatan->id);
        $this->assertModelData($fakeJabatan, $updatedJabatan->toArray());
        $dbJabatan = $this->jabatanRepo->find($jabatan->id);
        $this->assertModelData($fakeJabatan, $dbJabatan->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteJabatan()
    {
        $jabatan = $this->makeJabatan();
        $resp = $this->jabatanRepo->delete($jabatan->id);
        $this->assertTrue($resp);
        $this->assertNull(Jabatan::find($jabatan->id), 'Jabatan should not exist in DB');
    }
}
