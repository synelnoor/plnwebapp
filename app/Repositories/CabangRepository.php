<?php

namespace App\Repositories;

use App\Models\Cabang;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class CabangRepository
 * @package App\Repositories
 * @version February 8, 2019, 12:39 pm UTC
 *
 * @method Cabang findWithoutFail($id, $columns = ['*'])
 * @method Cabang find($id, $columns = ['*'])
 * @method Cabang first($columns = ['*'])
*/
class CabangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'code_cabang',
        'alamat',
        'deskripsi'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Cabang::class;
    }
}
