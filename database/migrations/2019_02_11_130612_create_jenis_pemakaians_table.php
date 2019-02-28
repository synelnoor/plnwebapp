<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJenisPemakaiansTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_pemakaians', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rfid_id');
            $table->integer('voucher_id');
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
        Schema::drop('jenis_pemakaians');
    }
}
