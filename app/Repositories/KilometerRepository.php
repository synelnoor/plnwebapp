<?php

namespace App\Repositories;

use App\Models\Kilometer;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class KilometerRepository
 * @package App\Repositories
 * @version February 8, 2019, 4:44 pm UTC
 *
 * @method Kilometer findWithoutFail($id, $columns = ['*'])
 * @method Kilometer find($id, $columns = ['*'])
 * @method Kilometer first($columns = ['*'])
*/
class KilometerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'car_id',
        'jumlah',
        'tanggal'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Kilometer::class;
    }
}
