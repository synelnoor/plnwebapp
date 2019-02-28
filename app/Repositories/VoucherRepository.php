<?php

namespace App\Repositories;

use App\Models\Voucher;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class VoucherRepository
 * @package App\Repositories
 * @version February 11, 2019, 12:20 pm UTC
 *
 * @method Voucher findWithoutFail($id, $columns = ['*'])
 * @method Voucher find($id, $columns = ['*'])
 * @method Voucher first($columns = ['*'])
*/
class VoucherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'no_voucher',
        'nama',
        'kategori_voucher'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Voucher::class;
    }
}
