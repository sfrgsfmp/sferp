<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTpkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tpk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_tpk');
            $table->unsignedBigInteger('kph_id');
            $table->foreign('kph_id')->references('id')->on('kph');
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
        Schema::dropIfExists('tpk');
    }
}
