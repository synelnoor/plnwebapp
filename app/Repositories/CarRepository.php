<?php

namespace App\Repositories;

use App\Models\Car;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class CarRepository
 * @package App\Repositories
 * @version February 8, 2019, 12:53 pm UTC
 *
 * @method Car findWithoutFail($id, $columns = ['*'])
 * @method Car find($id, $columns = ['*'])
 * @method Car first($columns = ['*'])
*/
class CarRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'no_polisi',
        'jenis_model',
        'jenis_bbm',
        'kilometer',
        'cabang_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Car::class;
    }
}
