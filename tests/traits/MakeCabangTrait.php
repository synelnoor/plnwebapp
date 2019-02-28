<?php

use Faker\Factory as Faker;
use App\Models\Cabang;
use App\Repositories\CabangRepository;

trait MakeCabangTrait
{
    /**
     * Create fake instance of Cabang and save it in database
     *
     * @param array $cabangFields
     * @return Cabang
     */
    public function makeCabang($cabangFields = [])
    {
        /** @var CabangRepository $cabangRepo */
        $cabangRepo = App::make(CabangRepository::class);
        $theme = $this->fakeCabangData($cabangFields);
        return $cabangRepo->create($theme);
    }

    /**
     * Get fake instance of Cabang
     *
     * @param array $cabangFields
     * @return Cabang
     */
    public function fakeCabang($cabangFields = [])
    {
        return new Cabang($this->fakeCabangData($cabangFields));
    }

    /**
     * Get fake data of Cabang
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCabangData($cabangFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'code_cabang' => $fake->word,
            'alamat' => $fake->text,
            'deskripsi' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $cabangFields);
    }
}
