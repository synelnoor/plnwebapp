<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class {YourModelName}ApiTest extends TestCase
{
    use Make{YourModelName}Trait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreate{YourModelName}()
    {
        ${YourModelName} = $this->fake{YourModelName}Data();
        $this->json('POST', '/api/v1/{YourModelName}s', ${YourModelName});

        $this->assertApiResponse(${YourModelName});
    }

    /**
     * @test
     */
    public function testRead{YourModelName}()
    {
        ${YourModelName} = $this->make{YourModelName}();
        $this->json('GET', '/api/v1/{YourModelName}s/'.${YourModelName}->id);

        $this->assertApiResponse(${YourModelName}->toArray());
    }

    /**
     * @test
     */
    public function testUpdate{YourModelName}()
    {
        ${YourModelName} = $this->make{YourModelName}();
        $edited{YourModelName} = $this->fake{YourModelName}Data();

        $this->json('PUT', '/api/v1/{YourModelName}s/'.${YourModelName}->id, $edited{YourModelName});

        $this->assertApiResponse($edited{YourModelName});
    }

    /**
     * @test
     */
    public function testDelete{YourModelName}()
    {
        ${YourModelName} = $this->make{YourModelName}();
        $this->json('DELETE', '/api/v1/{YourModelName}s/'.${YourModelName}->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/{YourModelName}s/'.${YourModelName}->id);

        $this->assertResponseStatus(404);
    }
}
