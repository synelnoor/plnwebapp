<?php

namespace App\Repositories;

use App\Models\JenisPemakaian;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class JenisPemakaianRepository
 * @package App\Repositories
 * @version February 11, 2019, 1:06 pm UTC
 *
 * @method JenisPemakaian findWithoutFail($id, $columns = ['*'])
 * @method JenisPemakaian find($id, $columns = ['*'])
 * @method JenisPemakaian first($columns = ['*'])
*/
class JenisPemakaianRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'rfid_id',
        'voucher_id',
        'tgl'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JenisPemakaian::class;
    }
}
