<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGISTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_i_s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kabupatenKota')->unsigned();
            $table->string('kabupaten_kota');
            $table->string('latitude');
            $table->string('longitude');
            $table->foreign('id_kabupatenKota')->references('id')->on('kabupaten_kotas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('g_i_s');
    }
}
