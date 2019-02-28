<?php

use Faker\Factory as Faker;
use App\Models\{YourModelName};
use App\Repositories\{YourModelName}Repository;

trait Make{YourModelName}Trait
{
    /**
     * Create fake instance of {YourModelName} and save it in database
     *
     * @param array ${YourModelName}Fields
     * @return {YourModelName}
     */
    public function make{YourModelName}(${YourModelName}Fields = [])
    {
        /** @var {YourModelName}Repository ${YourModelName}Repo */
        ${YourModelName}Repo = App::make({YourModelName}Repository::class);
        $theme = $this->fake{YourModelName}Data(${YourModelName}Fields);
        return ${YourModelName}Repo->create($theme);
    }

    /**
     * Get fake instance of {YourModelName}
     *
     * @param array ${YourModelName}Fields
     * @return {YourModelName}
     */
    public function fake{YourModelName}(${YourModelName}Fields = [])
    {
        return new {YourModelName}($this->fake{YourModelName}Data(${YourModelName}Fields));
    }

    /**
     * Get fake data of {YourModelName}
     *
     * @param array $postFields
     * @return array
     */
    public function fake{YourModelName}Data(${YourModelName}Fields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], ${YourModelName}Fields);
    }
}
