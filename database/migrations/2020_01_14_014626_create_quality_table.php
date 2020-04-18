<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quality_code');
            $table->string('quality_name');
            $table->string('quality_legend');
            $table->timestamps();
            $table->enum('is_delete', ['1', '0'])->default('0')->comment('1 delete, 0 active'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality');
    }
}
