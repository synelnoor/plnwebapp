<?php

namespace App\Repositories;

use App\Models\Driver;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class DriverRepository
 * @package App\Repositories
 * @version February 8, 2019, 12:31 pm UTC
 *
 * @method Driver findWithoutFail($id, $columns = ['*'])
 * @method Driver find($id, $columns = ['*'])
 * @method Driver first($columns = ['*'])
*/
class DriverRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'jabatan',
        'sim',
        'cabang_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Driver::class;
    }
}
