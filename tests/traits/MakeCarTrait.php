<?php

use Faker\Factory as Faker;
use App\Models\Car;
use App\Repositories\CarRepository;

trait MakeCarTrait
{
    /**
     * Create fake instance of Car and save it in database
     *
     * @param array $carFields
     * @return Car
     */
    public function makeCar($carFields = [])
    {
        /** @var CarRepository $carRepo */
        $carRepo = App::make(CarRepository::class);
        $theme = $this->fakeCarData($carFields);
        return $carRepo->create($theme);
    }

    /**
     * Get fake instance of Car
     *
     * @param array $carFields
     * @return Car
     */
    public function fakeCar($carFields = [])
    {
        return new Car($this->fakeCarData($carFields));
    }

    /**
     * Get fake data of Car
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCarData($carFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'no_polisi' => $fake->word,
            'jenis_model' => $fake->word,
            'jenis_bbm' => $fake->randomDigitNotNull,
            'kilometer' => $fake->randomDigitNotNull,
            'cabang_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $carFields);
    }
}
