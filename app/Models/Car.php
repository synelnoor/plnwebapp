<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Car",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="no_polisi",
 *          description="no_polisi",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="jenis_model",
 *          description="jenis_model",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="jenis_bbm",
 *          description="jenis_bbm",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="kilometer",
 *          description="kilometer",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cabang_id",
 *          description="cabang_id",
 *          type="integer",
 *          format="int32"
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
class Car extends Model
{
    use SoftDeletes;

    public $table = 'cars';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'no_polisi',
        'jenis_model',
        'jenis_bbm',
        'kilometer',
        'image',
        'cabang_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'no_polisi' => 'string',
        'jenis_model' => 'string',
        'jenis_bbm' => 'integer',
        'kilometer' => 'integer',
        'image'=> 'string',
        'cabang_id' => 'integer'
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
    public function cabang(){
        return $this->belongsTo(\App\Models\Cabang::class,'cabang_id','id');
    }
    public function kilometer(){
        return $this->hasMany(\App\Models\Kilometer::class);
    }
    public function status(){
        return $this->hasMany(\App\Models\Status::class);
    }
    
}
