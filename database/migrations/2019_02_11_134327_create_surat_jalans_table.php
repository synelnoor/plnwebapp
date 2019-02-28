<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuratJalansTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_jalans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_suratJalan');
            $table->date('tgl');
            $table->integer('car_id');
            $table->integer('driver_id');
            $table->integer('jenisPemakaian_id');
            $table->text('tujuan');
            $table->decimal('kilometer', 11, 2);
            $table->integer('cabang_id');
            $table->integer('status_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('surat_jalans');
    }
}
