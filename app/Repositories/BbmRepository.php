<?php

namespace App\Repositories;

use App\Models\Bbm;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class BbmRepository
 * @package App\Repositories
 * @version February 8, 2019, 1:24 pm UTC
 *
 * @method Bbm findWithoutFail($id, $columns = ['*'])
 * @method Bbm find($id, $columns = ['*'])
 * @method Bbm first($columns = ['*'])
*/
class BbmRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'liter',
        'harga'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Bbm::class;
    }
}
