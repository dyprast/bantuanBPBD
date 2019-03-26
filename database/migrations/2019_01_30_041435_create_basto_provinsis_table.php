<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBastoProvinsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basto_provinsis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_bantuanProvinsi')->unsigned();
            $table->string('nomor_basto')->nullable();
            $table->string('no_permohonan_hibah')->nullable();
            $table->string('no_bersedia_menerima_hibah')->nullable();
            $table->string('no_inventarisasi_barang')->nullable();
            $table->string('nomor_basto_file')->nullable();
            $table->string('no_permohonan_hibah_file')->nullable();
            $table->string('no_bersedia_menerima_hibah_file')->nullable();
            $table->string('no_inventarisasi_barang_file')->nullable();
            $table->string('bast_hibah')->nullable();
            $table->string('nasah_hibah')->nullable();
            $table->string('nilai_bantuan')->nullable();
            $table->string('rincian')->nullable();
            $table->foreign('id_bantuanProvinsi')->references('id')->on('bantuan_provinsis')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basto_provinsis');
    }
}
