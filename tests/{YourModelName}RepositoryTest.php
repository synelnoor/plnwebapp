<?php

use App\Models\{YourModelName};
use App\Repositories\{YourModelName}Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class {YourModelName}RepositoryTest extends TestCase
{
    use Make{YourModelName}Trait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var {YourModelName}Repository
     */
    protected ${YourModelName}Repo;

    public function setUp()
    {
        parent::setUp();
        $this->{YourModelName}Repo = App::make({YourModelName}Repository::class);
    }

    /**
     * @test create
     */
    public function testCreate{YourModelName}()
    {
        ${YourModelName} = $this->fake{YourModelName}Data();
        $created{YourModelName} = $this->{YourModelName}Repo->create(${YourModelName});
        $created{YourModelName} = $created{YourModelName}->toArray();
        $this->assertArrayHasKey('id', $created{YourModelName});
        $this->assertNotNull($created{YourModelName}['id'], 'Created {YourModelName} must have id specified');
        $this->assertNotNull({YourModelName}::find($created{YourModelName}['id']), '{YourModelName} with given id must be in DB');
        $this->assertModelData(${YourModelName}, $created{YourModelName});
    }

    /**
     * @test read
     */
    public function testRead{YourModelName}()
    {
        ${YourModelName} = $this->make{YourModelName}();
        $db{YourModelName} = $this->{YourModelName}Repo->find(${YourModelName}->id);
        $db{YourModelName} = $db{YourModelName}->toArray();
        $this->assertModelData(${YourModelName}->toArray(), $db{YourModelName});
    }

    /**
     * @test update
     */
    public function testUpdate{YourModelName}()
    {
        ${YourModelName} = $this->make{YourModelName}();
        $fake{YourModelName} = $this->fake{YourModelName}Data();
        $updated{YourModelName} = $this->{YourModelName}Repo->update($fake{YourModelName}, ${YourModelName}->id);
        $this->assertModelData($fake{YourModelName}, $updated{YourModelName}->toArray());
        $db{YourModelName} = $this->{YourModelName}Repo->find(${YourModelName}->id);
        $this->assertModelData($fake{YourModelName}, $db{YourModelName}->toArray());
    }

    /**
     * @test delete
     */
    public function testDelete{YourModelName}()
    {
        ${YourModelName} = $this->make{YourModelName}();
        $resp = $this->{YourModelName}Repo->delete(${YourModelName}->id);
        $this->assertTrue($resp);
        $this->assertNull({YourModelName}::find(${YourModelName}->id), '{YourModelName} should not exist in DB');
    }
}
