<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Driver",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nama",
 *          description="nama",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="jabatan",
 *          description="jabatan",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="sim",
 *          description="sim",
 *          type="string"
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
class Driver extends Model
{
    use SoftDeletes;

    public $table = 'drivers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'jabatan',
        'sim',
        'image',
        'bio',
        'cabang_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'jabatan' => 'string',
        'sim' => 'string',
        'image' =>'string',
        'bio' => 'string',
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
    public function status(){
        return $this->hasMany(\App\Models\Status::class);
    }
    
}
