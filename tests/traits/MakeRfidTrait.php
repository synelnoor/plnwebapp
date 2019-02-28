<?php

use Faker\Factory as Faker;
use App\Models\Rfid;
use App\Repositories\RfidRepository;

trait MakeRfidTrait
{
    /**
     * Create fake instance of Rfid and save it in database
     *
     * @param array $rfidFields
     * @return Rfid
     */
    public function makeRfid($rfidFields = [])
    {
        /** @var RfidRepository $rfidRepo */
        $rfidRepo = App::make(RfidRepository::class);
        $theme = $this->fakeRfidData($rfidFields);
        return $rfidRepo->create($theme);
    }

    /**
     * Get fake instance of Rfid
     *
     * @param array $rfidFields
     * @return Rfid
     */
    public function fakeRfid($rfidFields = [])
    {
        return new Rfid($this->fakeRfidData($rfidFields));
    }

    /**
     * Get fake data of Rfid
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRfidData($rfidFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nomor' => $fake->word,
            'saldo' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $rfidFields);
    }
}
