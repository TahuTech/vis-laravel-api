<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_balita');
            $table->double('u');
            $table->double('bb');
            $table->double('tb');
            $table->double('lkkepala');
            $table->enum('bulan', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']);
            $table->enum('gizi', ['1', '2', '3', '4']);
            $table->enum('berat', ['1', '2', '3', '4']);
            $table->enum('tinggi', ['1', '2', '3', '4']);
            $table->enum('stunting', ['1', '2', '3', '4']);
            $table->timestamps();

            $table->foreign('id_balita')->references('id')->on('balitas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('knns');
    }
}
