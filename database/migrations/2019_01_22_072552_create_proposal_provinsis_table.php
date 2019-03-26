<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalProvinsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_provinsis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_provinsi')->unsigned();
            $table->string('nomor');
            $table->string('jenis_bantuan');
            $table->string('isi_ringkasan')->nullable();
            $table->string('tanggal');
            $table->string('tahun', 5);
            $table->timestamps();
            $table->foreign('id_provinsi')->references('id')->on('provinsis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal_provinsis');
    }
}
