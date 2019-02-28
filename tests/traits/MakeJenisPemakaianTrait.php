<?php

use Faker\Factory as Faker;
use App\Models\JenisPemakaian;
use App\Repositories\JenisPemakaianRepository;

trait MakeJenisPemakaianTrait
{
    /**
     * Create fake instance of JenisPemakaian and save it in database
     *
     * @param array $jenisPemakaianFields
     * @return JenisPemakaian
     */
    public function makeJenisPemakaian($jenisPemakaianFields = [])
    {
        /** @var JenisPemakaianRepository $jenisPemakaianRepo */
        $jenisPemakaianRepo = App::make(JenisPemakaianRepository::class);
        $theme = $this->fakeJenisPemakaianData($jenisPemakaianFields);
        return $jenisPemakaianRepo->create($theme);
    }

    /**
     * Get fake instance of JenisPemakaian
     *
     * @param array $jenisPemakaianFields
     * @return JenisPemakaian
     */
    public function fakeJenisPemakaian($jenisPemakaianFields = [])
    {
        return new JenisPemakaian($this->fakeJenisPemakaianData($jenisPemakaianFields));
    }

    /**
     * Get fake data of JenisPemakaian
     *
     * @param array $postFields
     * @return array
     */
    public function fakeJenisPemakaianData($jenisPemakaianFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'rfid_id' => $fake->randomDigitNotNull,
            'voucher_id' => $fake->randomDigitNotNull,
            'tgl' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $jenisPemakaianFields);
    }
}
