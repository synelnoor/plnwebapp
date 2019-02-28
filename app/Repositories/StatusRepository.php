<?php

namespace App\Repositories;

use App\Models\Status;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class StatusRepository
 * @package App\Repositories
 * @version February 8, 2019, 12:58 pm UTC
 *
 * @method Status findWithoutFail($id, $columns = ['*'])
 * @method Status find($id, $columns = ['*'])
 * @method Status first($columns = ['*'])
*/
class StatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'driver_id',
        'car_id',
        'status',
        'tanggal'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Status::class;
    }
}
