<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLapSuratJalansTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lap_surat_jalans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('suratjalan_id');
            $table->integer('status_id');
            $table->date('tgl');
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
        Schema::drop('lap_surat_jalans');
    }
}
