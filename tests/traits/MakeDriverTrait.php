<?php

use Faker\Factory as Faker;
use App\Models\Driver;
use App\Repositories\DriverRepository;

trait MakeDriverTrait
{
    /**
     * Create fake instance of Driver and save it in database
     *
     * @param array $driverFields
     * @return Driver
     */
    public function makeDriver($driverFields = [])
    {
        /** @var DriverRepository $driverRepo */
        $driverRepo = App::make(DriverRepository::class);
        $theme = $this->fakeDriverData($driverFields);
        return $driverRepo->create($theme);
    }

    /**
     * Get fake instance of Driver
     *
     * @param array $driverFields
     * @return Driver
     */
    public function fakeDriver($driverFields = [])
    {
        return new Driver($this->fakeDriverData($driverFields));
    }

    /**
     * Get fake data of Driver
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDriverData($driverFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'jabatan' => $fake->word,
            'sim' => $fake->word,
            'cabang_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $driverFields);
    }
}
