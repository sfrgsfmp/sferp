<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptlogdetailDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiptlogdetail_document', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->unsignedBigInteger('receiptlog_id');
            $table->foreign('receiptlog_id')->references('id')->on('receiptlog');
            $table->string('nextmap');
            $table->string('nokayu')->nullable();
            $table->double('dia')->nullable();
            $table->double('length')->nullable();
            $table->double('height')->nullable();
            $table->double('width')->nullable();
            $table->double('m3')->nullable();
            $table->string('nobarcode')->nullable();
            $table->string('nopohon')->nullable();
            $table->string('nopetak')->nullable();
            $table->string('quality')->nullable();
            $table->string('nokapling')->nullable();
            $table->string('nobp')->nullable();
            $table->string('umurkapling')->nullable();
            $table->string('kayuno2')->nullable();
            $table->string('partaibp')->nullable();
            $table->string('asaltahun')->nullable();

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
        Schema::dropIfExists('receiptlogdetail_document');
    }
}
