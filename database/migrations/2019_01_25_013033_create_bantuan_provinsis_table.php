<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBantuanProvinsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bantuan_provinsis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_proposalProvinsi')->unsigned()->nullable();
            $table->integer('id_provinsi')->unsigned()->nullable();
            $table->string('tahun_perolehan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('jenis_bantuan')->nullable();
            $table->string('risiko')->nullable();
            $table->string('pembentukan')->nullable();
            $table->string('nilai')->nullable();
            $table->string('rincian')->nullable();
            $table->boolean('loop_data')->nullable();
            $table->foreign('id_proposalProvinsi')->references('id')->on('proposal_provinsis')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('bantuan_provinsis');
    }
}
