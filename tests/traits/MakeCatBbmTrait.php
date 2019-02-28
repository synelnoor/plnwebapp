<?php

use Faker\Factory as Faker;
use App\Models\CatBbm;
use App\Repositories\CatBbmRepository;

trait MakeCatBbmTrait
{
    /**
     * Create fake instance of CatBbm and save it in database
     *
     * @param array $catBbmFields
     * @return CatBbm
     */
    public function makeCatBbm($catBbmFields = [])
    {
        /** @var CatBbmRepository $catBbmRepo */
        $catBbmRepo = App::make(CatBbmRepository::class);
        $theme = $this->fakeCatBbmData($catBbmFields);
        return $catBbmRepo->create($theme);
    }

    /**
     * Get fake instance of CatBbm
     *
     * @param array $catBbmFields
     * @return CatBbm
     */
    public function fakeCatBbm($catBbmFields = [])
    {
        return new CatBbm($this->fakeCatBbmData($catBbmFields));
    }

    /**
     * Get fake data of CatBbm
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCatBbmData($catBbmFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'bbm_id' => $fake->randomDigitNotNull,
            'car_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $catBbmFields);
    }
}
