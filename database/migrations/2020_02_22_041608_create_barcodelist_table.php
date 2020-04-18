<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarcodelistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcodelist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tt_id');
            $table->foreign('tt_id')->references('id')->on('tandaterima');
            $table->string('barcode');
            $table->enum('is_delete', ['0','1'])->default('0');
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
        Schema::dropIfExists('barcodelist');
    }
}
