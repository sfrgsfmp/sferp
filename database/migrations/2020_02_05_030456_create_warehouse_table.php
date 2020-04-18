<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('warehouse_code')->unique();
            $table->string('warehouse_name');
            $table->string('warehouse_group')->nullable();
            $table->enum('warehouse_type', ['1','2','3','4']);
            $table->string('warehouse_loc')->nullable();
            $table->text('warehouse_desc');
            $table->unsignedBigInteger('id_objective')->nullable();
            $table->foreign('id_objective')->references('id')->on('objective');
            $table->enum('is_delete',['0','1'])->default('0');
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
        Schema::dropIfExists('warehouse');
    }
}
