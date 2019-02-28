<?php

namespace App\Repositories;

use App\Models\Rfid;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class RfidRepository
 * @package App\Repositories
 * @version February 11, 2019, 12:07 pm UTC
 *
 * @method Rfid findWithoutFail($id, $columns = ['*'])
 * @method Rfid find($id, $columns = ['*'])
 * @method Rfid first($columns = ['*'])
*/
class RfidRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nomor',
        'saldo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Rfid::class;
    }
}
