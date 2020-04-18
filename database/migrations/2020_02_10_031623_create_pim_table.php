<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pim', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_pim')->unique();
            $table->string('pimno');
            $table->string('division');
            $table->unsignedBigInteger('itemgroup_id');
            $table->foreign('itemgroup_id')->references('id')->on('itemgroup');
            $table->date('applydate');
            $table->unsignedBigInteger('objective');
            $table->foreign('objective')->references('id')->on('objective');
            $table->string('process');
            $table->unsignedBigInteger('warehouse_id');
            $table->foreign('warehouse_id')->references('id')->on('warehouse');
            $table->string('carasusun');
            $table->text('soplangkah');
            $table->unsignedBigInteger('po_reference');
            $table->foreign('po_reference')->references('id')->on('po_transaction');
            $table->string('noprocurement');
            $table->string('noparcel');
            $table->string('bp');
            
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendor');
            $table->unsignedBigInteger('kbm_id')->nullable();
            $table->foreign('kbm_id')->references('id')->on('kbm');
            $table->unsignedBigInteger('kph_id')->nullable();
            $table->foreign('kph_id')->references('id')->on('kph');
            $table->unsignedBigInteger('tpk_id')->nullable();
            $table->foreign('tpk_id')->references('id')->on('tpk');

            $table->string('ftebal');
            $table->string('flebar');
            $table->string('fpanjang');

            $table->string('sortimen');
            
            // $table->string('spec2_id');
            $table->unsignedBigInteger('spec2_id');
            $table->foreign('spec2_id')->references('id')->on('specification');

            $table->string('specs');
            $table->unsignedBigInteger('contractor_id');
            $table->foreign('contractor_id')->references('id')->on('vendor');
            $table->text('informasilain');
            $table->text('note');
            $table->unsignedBigInteger('type_transport_id');
            $table->foreign('type_transport_id')->references('id')->on('vehicle');
            $table->string('notransport');
            $table->text('desc');
            $table->string('typem3');
            $table->float('estdocm3');
            $table->unsignedBigInteger('whbongkar');
            $table->foreign('whbongkar')->references('id')->on('warehouse');
            $table->unsignedBigInteger('whstapel');
            $table->foreign('whstapel')->references('id')->on('warehouse');

            $table->time('starttime');
            $table->time('endtime');
            $table->integer('headcount')->default('0');
            $table->date('date');
            $table->string('spb');

            $table->date('datesupplierpayment');
            $table->integer('totalqty')->default('0');
            $table->integer('totalm3')->default('0');
            $table->integer('totalinvprice')->default('0');
            $table->text('desc_sup');
            $table->string('workshift');
            $table->string('rateused');

            $table->unsignedInteger('handling');
            $table->foreign('handling')->references('id')->on('handling');
            
            $table->unsignedBigInteger('code_expeditionpayment');
            $table->foreign('code_expeditionpayment')->references('id')->on('vendor');

            $table->date('paydate_expeditionpayment');
            $table->string('price_expeditionpayment');

            $table->unsignedBigInteger('code_freightpayment');
            $table->foreign('code_freightpayment')->references('id')->on('vendor');

            $table->string('emkl');
            $table->date('paydate_freightpayment');

            $table->string('conttype');
            $table->string('price_freightpayment');

            $table->string('grading_expenses');
            $table->string('biayalelang');
            $table->string('retribusi');
            $table->string('biayalansir');
            $table->string('fee');
            // $table->string('region');

            $table->timestamps();
            $table->enum('is_delete',['0','1'])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pim');
    }
}
