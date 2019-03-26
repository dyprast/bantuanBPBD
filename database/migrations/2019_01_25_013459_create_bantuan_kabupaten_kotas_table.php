<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBantuanKabupatenKotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bantuan_kabupaten_kotas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_proposalKabupatenKota')->unsigned();
            $table->integer('id_provinsi')->unsigned();
            $table->integer('id_kabupatenKota')->unsigned();
            $table->string('tahun_perolehan');
            $table->string('keterangan');
            $table->string('jenis_bantuan');
            $table->string('risiko');
            $table->string('pembentukan');
            $table->string('nilai');
            $table->string('rincian')->nullable();
            $table->boolean('loop_data');
            $table->foreign('id_proposalKabupatenKota')->references('id')->on('proposal_kabupaten_kotas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('bantuan_kabupaten_kotas');
    }
}
