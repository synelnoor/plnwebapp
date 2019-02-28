<?php

use Faker\Factory as Faker;
use App\Models\KategoriVoucher;
use App\Repositories\KategoriVoucherRepository;

trait MakeKategoriVoucherTrait
{
    /**
     * Create fake instance of KategoriVoucher and save it in database
     *
     * @param array $kategoriVoucherFields
     * @return KategoriVoucher
     */
    public function makeKategoriVoucher($kategoriVoucherFields = [])
    {
        /** @var KategoriVoucherRepository $kategoriVoucherRepo */
        $kategoriVoucherRepo = App::make(KategoriVoucherRepository::class);
        $theme = $this->fakeKategoriVoucherData($kategoriVoucherFields);
        return $kategoriVoucherRepo->create($theme);
    }

    /**
     * Get fake instance of KategoriVoucher
     *
     * @param array $kategoriVoucherFields
     * @return KategoriVoucher
     */
    public function fakeKategoriVoucher($kategoriVoucherFields = [])
    {
        return new KategoriVoucher($this->fakeKategoriVoucherData($kategoriVoucherFields));
    }

    /**
     * Get fake data of KategoriVoucher
     *
     * @param array $postFields
     * @return array
     */
    public function fakeKategoriVoucherData($kategoriVoucherFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'nominal' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $kategoriVoucherFields);
    }
}
