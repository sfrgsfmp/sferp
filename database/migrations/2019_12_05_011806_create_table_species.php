<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSpecies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('species');
            // $table->timestamps();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('legend');
            $table->string('autocode');
            $table->enum('spec', ['Solid', '2Layer', '3Layer', '4Layer']);
            $table->string('latinname');
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
        Schema::dropIfExists('species');
    }
}
