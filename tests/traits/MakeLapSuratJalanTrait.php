<?php

use Faker\Factory as Faker;
use App\Models\LapSuratJalan;
use App\Repositories\LapSuratJalanRepository;

trait MakeLapSuratJalanTrait
{
    /**
     * Create fake instance of LapSuratJalan and save it in database
     *
     * @param array $lapSuratJalanFields
     * @return LapSuratJalan
     */
    public function makeLapSuratJalan($lapSuratJalanFields = [])
    {
        /** @var LapSuratJalanRepository $lapSuratJalanRepo */
        $lapSuratJalanRepo = App::make(LapSuratJalanRepository::class);
        $theme = $this->fakeLapSuratJalanData($lapSuratJalanFields);
        return $lapSuratJalanRepo->create($theme);
    }

    /**
     * Get fake instance of LapSuratJalan
     *
     * @param array $lapSuratJalanFields
     * @return LapSuratJalan
     */
    public function fakeLapSuratJalan($lapSuratJalanFields = [])
    {
        return new LapSuratJalan($this->fakeLapSuratJalanData($lapSuratJalanFields));
    }

    /**
     * Get fake data of LapSuratJalan
     *
     * @param array $postFields
     * @return array
     */
    public function fakeLapSuratJalanData($lapSuratJalanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'suratjalan_id' => $fake->randomDigitNotNull,
            'status_id' => $fake->randomDigitNotNull,
            'tgl' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $lapSuratJalanFields);
    }
}
