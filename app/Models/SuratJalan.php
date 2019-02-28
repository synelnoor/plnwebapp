<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="SuratJalan",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="no_suratJalan",
 *          description="no_suratJalan",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tgl",
 *          description="tgl",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="car_id",
 *          description="car_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="driver_id",
 *          description="driver_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="jenisPemakaian_id",
 *          description="jenisPemakaian_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="tujuan",
 *          description="tujuan",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="kilometer",
 *          description="kilometer",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="cabang_id",
 *          description="cabang_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status_id",
 *          description="status_id",
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
class SuratJalan extends Model
{
    use SoftDeletes;

    public $table = 'surat_jalans';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'no_suratJalan',
        'tgl',
        'car_id',
        'driver_id',
        'jenisPemakaian_id',
        'tujuan',
        'kilometer',
        'cabang_id',
        'status_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'no_suratJalan' => 'string',
        'tgl' => 'date',
        'car_id' => 'integer',
        'driver_id' => 'integer',
        'jenisPemakaian_id' => 'integer',
        'tujuan' => 'string',
        'cabang_id' => 'integer',
        'status_id' => 'integer'
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

    public function jenisPemakaian(){
        return $this->hasMany(\App\Models\JenisPemakaian::class);
    }
    // public function jPemakaian(){
    //     return $this->belongsTo(\App\Models\JenisPemakaian::class,'jenisPemakaian_id','id');
    // }
    
    public function status(){
        return $this->belongsTo(\App\Models\Status::class,'status_id','id');
    }
    
}
