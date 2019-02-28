<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Kilometer",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="car_id",
 *          description="car_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="jumlah",
 *          description="jumlah",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="tanggal",
 *          description="tanggal",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Kilometer extends Model
{
    use SoftDeletes;

    public $table = 'kilometers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'car_id',
        'jumlah',
        'tanggal'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'car_id' => 'integer',
        'jumlah' => 'integer',
        'tanggal' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function car(){
        return $this->belongsTo(\App\Models\Car::class,'car_id','id');
    }

    
}
