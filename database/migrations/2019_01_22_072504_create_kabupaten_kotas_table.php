<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKabupatenKotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kabupaten_kotas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_provinsi')->unsigned();
            $table->string('kabupaten_kota');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->foreign('id_provinsi')->references('id')->on('provinsis')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('kabupaten_kotas');
    }
}
