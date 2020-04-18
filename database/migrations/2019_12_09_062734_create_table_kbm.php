<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKbm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kbm', function (Blueprint $table) {
            // $table->Integer('id')->primary()->increments()->length(10);
            // $table->increments('id')->primary()->length(10);
            // $table->increments('id')->primary()->length(10);
            $table->bigIncrements('id')->length(10);

            $table->char('province_id',2);
            $table->foreign('province_id')->references('id')->on('indonesia_provinces');

            $table->string('name_kbm');
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
        Schema::dropIfExists('kbm');
    }
}
