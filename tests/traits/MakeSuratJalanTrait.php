<?php

use Faker\Factory as Faker;
use App\Models\SuratJalan;
use App\Repositories\SuratJalanRepository;

trait MakeSuratJalanTrait
{
    /**
     * Create fake instance of SuratJalan and save it in database
     *
     * @param array $suratJalanFields
     * @return SuratJalan
     */
    public function makeSuratJalan($suratJalanFields = [])
    {
        /** @var SuratJalanRepository $suratJalanRepo */
        $suratJalanRepo = App::make(SuratJalanRepository::class);
        $theme = $this->fakeSuratJalanData($suratJalanFields);
        return $suratJalanRepo->create($theme);
    }

    /**
     * Get fake instance of SuratJalan
     *
     * @param array $suratJalanFields
     * @return SuratJalan
     */
    public function fakeSuratJalan($suratJalanFields = [])
    {
        return new SuratJalan($this->fakeSuratJalanData($suratJalanFields));
    }

    /**
     * Get fake data of SuratJalan
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSuratJalanData($suratJalanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'no_suratJalan' => $fake->word,
            'tgl' => $fake->word,
            'car_id' => $fake->randomDigitNotNull,
            'driver_id' => $fake->randomDigitNotNull,
            'jenisPemakaian_id' => $fake->randomDigitNotNull,
            'tujuan' => $fake->text,
            'kilometer' => $fake->word,
            'cabang_id' => $fake->randomDigitNotNull,
            'status_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $suratJalanFields);
    }
}
