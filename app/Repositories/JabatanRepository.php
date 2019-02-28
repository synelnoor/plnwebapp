<?php

namespace App\Repositories;

use App\Models\Jabatan;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class JabatanRepository
 * @package App\Repositories
 * @version February 11, 2019, 3:01 pm UTC
 *
 * @method Jabatan findWithoutFail($id, $columns = ['*'])
 * @method Jabatan find($id, $columns = ['*'])
 * @method Jabatan first($columns = ['*'])
*/
class JabatanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'desc'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Jabatan::class;
    }
}
