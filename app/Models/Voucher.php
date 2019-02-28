<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Voucher",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="no_voucher",
 *          description="no_voucher",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="nama",
 *          description="nama",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="kategori_voucher",
 *          description="kategori_voucher",
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
class Voucher extends Model
{
    use SoftDeletes;

    public $table = 'vouchers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'no_voucher',
        'nama',
        'kategori_voucher',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'no_voucher' => 'string',
        'nama' => 'string',
        'kategori_voucher' => 'integer',
        'status'=>'integer'
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

     public function kategori(){
        return $this->belongsTo(\App\Models\KategoriVoucher::class,'kategori_voucher','id');
    }

    public function jenisPemakaian(){
        return $this->hasMany(\App\Models\JenisPemakaian::class);
    }
    
}
