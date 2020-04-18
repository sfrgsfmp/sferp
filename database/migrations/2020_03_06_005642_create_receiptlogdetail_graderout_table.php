<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptlogdetailGraderoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiptlogdetail_graderout', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->unsignedBigInteger('receiptlog_id');
            $table->foreign('receiptlog_id')->references('id')->on('receiptlog');
            $table->string('nextmap');
            $table->string('nokayu')->nullable();
            $table->string('kwt')->nullable();
            
            $table->double('dia1')->nullable();
            $table->double('dia2')->nullable();
            $table->double('dia3')->nullable();
            $table->double('dia4')->nullable();
            $table->double('dia_avg')->nullable();
            
            $table->string('class')->nullable();
            $table->double('heightfull')->nullable();
            $table->double('widthfull')->nullable();
            $table->double('lenfull')->nullable();
            $table->double('lenmin')->nullable();
            $table->double('lennett')->nullable();
            $table->double('heighttrim')->nullable();
            $table->double('widthtrim')->nullable();
            $table->double('lengr')->nullable();
            $table->double('lenkm')->nullable();
            $table->double('lentrim')->nullable();
            $table->double('heightmin')->nullable();
            $table->double('heightnett')->nullable();
            $table->double('widthmin')->nullable();
            $table->double('widthnett')->nullable();
            $table->double('p_len')->nullable();
            $table->double('p_m3')->nullable();
            $table->double('dia_gr')->nullable();
            $table->string('nobarcode')->nullable();
            $table->string('nopohon')->nullable();
            $table->string('nopetak')->nullable();
            $table->double('po_price')->nullable();
            $table->double('gross_price')->nullable();
            $table->integer('discount')->nullable();
            $table->double('discount_value')->nullable();
            $table->integer('surcharges')->nullable();
            $table->double('surcharges_value')->nullable();
            $table->integer('adj')->nullable();

            $table->double('dia1_teras')->nullable();
            $table->double('dia2_teras')->nullable();
            $table->double('dia3_teras')->nullable();
            $table->double('dia4_teras')->nullable();
            $table->double('diaavg_teras')->nullable();
            
            $table->double('p_m3_teras')->nullable();
            $table->double('po_price_teras')->nullable();
            $table->double('gross_price_teras')->nullable();
            $table->integer('discount_teras')->nullable();
            $table->double('discountvalue_teras')->nullable();
            $table->integer('surcharges_value_teras')->nullable();
            $table->integer('adj_teras')->nullable();
            $table->double('owner')->nullable();
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
        Schema::dropIfExists('receiptlogdetail_graderout');
    }
}
