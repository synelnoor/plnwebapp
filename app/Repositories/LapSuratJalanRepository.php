<?php

namespace App\Repositories;

use App\Models\LapSuratJalan;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class LapSuratJalanRepository
 * @package App\Repositories
 * @version February 11, 2019, 1:46 pm UTC
 *
 * @method LapSuratJalan findWithoutFail($id, $columns = ['*'])
 * @method LapSuratJalan find($id, $columns = ['*'])
 * @method LapSuratJalan first($columns = ['*'])
*/
class LapSuratJalanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'suratjalan_id',
        'status_id',
        'tgl'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LapSuratJalan::class;
    }
}
