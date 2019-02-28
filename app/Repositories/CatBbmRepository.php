<?php

namespace App\Repositories;

use App\Models\CatBbm;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class CatBbmRepository
 * @package App\Repositories
 * @version February 11, 2019, 11:40 am UTC
 *
 * @method CatBbm findWithoutFail($id, $columns = ['*'])
 * @method CatBbm find($id, $columns = ['*'])
 * @method CatBbm first($columns = ['*'])
*/
class CatBbmRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'bbm_id',
        'car_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CatBbm::class;
    }
}
