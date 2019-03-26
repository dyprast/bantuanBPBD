<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalKabupatenKotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_kabupaten_kotas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_provinsi')->unsigned();
            $table->integer('id_kabupatenKota')->unsigned();
            $table->string('kabupaten_kota');
            $table->string('nomor');
            $table->string('jenis_bantuan');
            $table->string('isi_ringkasan')->nullable();
            $table->string('tanggal');
            $table->string('tahun', 5);
            $table->timestamps();
            $table->foreign('id_provinsi')->references('id')->on('provinsis');
            $table->foreign('id_kabupatenKota')->references('id')->on('kabupaten_kotas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal_kabupaten_kotas');
    }
}
