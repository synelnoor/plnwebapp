<?php

namespace App\Repositories;

use App\Models\{YourModelName};
use Webcore\Generator\Common\BaseRepository;

/**
 * Class {YourModelName}Repository
 * @package App\Repositories
 * @version February 8, 2019, 12:28 pm UTC
 *
 * @method {YourModelName} findWithoutFail($id, $columns = ['*'])
 * @method {YourModelName} find($id, $columns = ['*'])
 * @method {YourModelName} first($columns = ['*'])
*/
class {YourModelName}Repository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return {YourModelName}::class;
    }
}
