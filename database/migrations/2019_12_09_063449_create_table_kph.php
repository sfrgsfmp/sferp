<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKph extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kph', function (Blueprint $table) {
            
            // $table->increments('id')->primary()->length(10);
            // $table->increments('id')->primary()->length(10);
            // $table->increments('id',10);
            $table->bigIncrements('id')->length(10);
            $table->unsignedBigInteger('kbm_id')->length(10);
            $table->foreign('kbm_id')->references('id')->on('kbm');
            $table->string('name_kph');
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
        Schema::dropIfExists('kph');
    }
}
