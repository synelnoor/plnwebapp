<?php

namespace App\Repositories;

use App\Models\KategoriVoucher;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class KategoriVoucherRepository
 * @package App\Repositories
 * @version February 11, 2019, 12:29 pm UTC
 *
 * @method KategoriVoucher findWithoutFail($id, $columns = ['*'])
 * @method KategoriVoucher find($id, $columns = ['*'])
 * @method KategoriVoucher first($columns = ['*'])
*/
class KategoriVoucherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'nominal'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return KategoriVoucher::class;
    }
}
