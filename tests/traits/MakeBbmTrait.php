<?php

use Faker\Factory as Faker;
use App\Models\Bbm;
use App\Repositories\BbmRepository;

trait MakeBbmTrait
{
    /**
     * Create fake instance of Bbm and save it in database
     *
     * @param array $bbmFields
     * @return Bbm
     */
    public function makeBbm($bbmFields = [])
    {
        /** @var BbmRepository $bbmRepo */
        $bbmRepo = App::make(BbmRepository::class);
        $theme = $this->fakeBbmData($bbmFields);
        return $bbmRepo->create($theme);
    }

    /**
     * Get fake instance of Bbm
     *
     * @param array $bbmFields
     * @return Bbm
     */
    public function fakeBbm($bbmFields = [])
    {
        return new Bbm($this->fakeBbmData($bbmFields));
    }

    /**
     * Get fake data of Bbm
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBbmData($bbmFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'liter' => $fake->word,
            'harga' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $bbmFields);
    }
}
