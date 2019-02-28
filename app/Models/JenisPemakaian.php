<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="JenisPemakaian",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="rfid_id",
 *          description="rfid_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="voucher_id",
 *          description="voucher_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="tgl",
 *          description="tgl",
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
class JenisPemakaian extends Model
{
    use SoftDeletes;

    public $table = 'jenis_pemakaians';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'rfid_id',
        'voucher_id',
        'suratjalan_id',
        'tgl'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'rfid_id' => 'integer',
        'voucher_id' => 'integer',
        'suratjalan_id' =>'integer',
        'tgl' => 'date'
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

     public function rfid(){
        return $this->belongsTo(\App\Models\Rfid::class,'rfid_id','id');
    }
     public function voucher(){
        return $this->belongsTo(\App\Models\Voucher::class,'voucher_id','id');
    }
     public function suratjalan(){
        return $this->belongsTo(\App\Models\SuratJalan::class,'suratjalan_id','id');
    }

    
}
