<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSpecification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('legend');
            $table->string('autocode');
            $table->string('vendorname');
            $table->enum('type_specification', ['1', '2', '3']); //1 spec1, 2 spec2, 3 spec3
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
        Schema::dropIfExists('specification');
    }
}
