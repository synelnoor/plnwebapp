<?php

use Faker\Factory as Faker;
use App\Models\Jabatan;
use App\Repositories\JabatanRepository;

trait MakeJabatanTrait
{
    /**
     * Create fake instance of Jabatan and save it in database
     *
     * @param array $jabatanFields
     * @return Jabatan
     */
    public function makeJabatan($jabatanFields = [])
    {
        /** @var JabatanRepository $jabatanRepo */
        $jabatanRepo = App::make(JabatanRepository::class);
        $theme = $this->fakeJabatanData($jabatanFields);
        return $jabatanRepo->create($theme);
    }

    /**
     * Get fake instance of Jabatan
     *
     * @param array $jabatanFields
     * @return Jabatan
     */
    public function fakeJabatan($jabatanFields = [])
    {
        return new Jabatan($this->fakeJabatanData($jabatanFields));
    }

    /**
     * Get fake data of Jabatan
     *
     * @param array $postFields
     * @return array
     */
    public function fakeJabatanData($jabatanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'desc' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $jabatanFields);
    }
}
