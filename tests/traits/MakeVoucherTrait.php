<?php

use Faker\Factory as Faker;
use App\Models\Voucher;
use App\Repositories\VoucherRepository;

trait MakeVoucherTrait
{
    /**
     * Create fake instance of Voucher and save it in database
     *
     * @param array $voucherFields
     * @return Voucher
     */
    public function makeVoucher($voucherFields = [])
    {
        /** @var VoucherRepository $voucherRepo */
        $voucherRepo = App::make(VoucherRepository::class);
        $theme = $this->fakeVoucherData($voucherFields);
        return $voucherRepo->create($theme);
    }

    /**
     * Get fake instance of Voucher
     *
     * @param array $voucherFields
     * @return Voucher
     */
    public function fakeVoucher($voucherFields = [])
    {
        return new Voucher($this->fakeVoucherData($voucherFields));
    }

    /**
     * Get fake data of Voucher
     *
     * @param array $postFields
     * @return array
     */
    public function fakeVoucherData($voucherFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'no_voucher' => $fake->word,
            'nama' => $fake->word,
            'kategori_voucher' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $voucherFields);
    }
}
