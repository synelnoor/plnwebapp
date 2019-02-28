<?php

namespace App\Repositories;

use App\Models\SuratJalan;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class SuratJalanRepository
 * @package App\Repositories
 * @version February 11, 2019, 1:43 pm UTC
 *
 * @method SuratJalan findWithoutFail($id, $columns = ['*'])
 * @method SuratJalan find($id, $columns = ['*'])
 * @method SuratJalan first($columns = ['*'])
*/
class SuratJalanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'no_suratJalan',
        'tgl',
        'car_id',
        'driver_id',
        'jenisPemakaian_id',
        'tujuan',
        'kilometer',
        'cabang_id',
        'status_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SuratJalan::class;
    }
}
