<?php

use Faker\Factory as Faker;
use App\Models\Kilometer;
use App\Repositories\KilometerRepository;

trait MakeKilometerTrait
{
    /**
     * Create fake instance of Kilometer and save it in database
     *
     * @param array $kilometerFields
     * @return Kilometer
     */
    public function makeKilometer($kilometerFields = [])
    {
        /** @var KilometerRepository $kilometerRepo */
        $kilometerRepo = App::make(KilometerRepository::class);
        $theme = $this->fakeKilometerData($kilometerFields);
        return $kilometerRepo->create($theme);
    }

    /**
     * Get fake instance of Kilometer
     *
     * @param array $kilometerFields
     * @return Kilometer
     */
    public function fakeKilometer($kilometerFields = [])
    {
        return new Kilometer($this->fakeKilometerData($kilometerFields));
    }

    /**
     * Get fake data of Kilometer
     *
     * @param array $postFields
     * @return array
     */
    public function fakeKilometerData($kilometerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'car_id' => $fake->randomDigitNotNull,
            'jumlah' => $fake->randomDigitNotNull,
            'tanggal' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $kilometerFields);
    }
}
