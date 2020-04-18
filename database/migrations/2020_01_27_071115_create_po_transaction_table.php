<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            
            $table->unsignedBigInteger('ipl');
            $table->foreign('ipl')->references('id')->on('ipl');
            $table->unsignedBigInteger('speciess');
            $table->foreign('speciess')->references('id')->on('species');

            $table->string('amended1')->nullable();
            $table->string('amended2')->nullable();
            $table->string('amended3')->nullable();
            $table->date('startcontract');
            $table->date('expiredcontract');
            $table->string('status');
            $table->unsignedBigInteger('itemgroup_id');
            $table->foreign('itemgroup_id')->references('id')->on('itemgroup');
            $table->unsignedBigInteger('spec_id');
            $table->foreign('spec_id')->references('id')->on('specification');
            
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendor');
            // $table->unsignedBigInteger('kbm_id');
            // $table->foreign('kbm_id')->references('kbm_id')->on('kbm');
            // $table->unsignedBigInteger('kph_id');
            // $table->foreign('kph_id')->references('kph_id')->on('kph');
            // $table->unsignedBigInteger('tpk_id');
            // $table->foreign('tpk_id')->references('tpk_id')->on('tpk');
            
            $table->text('paymentnote');
            
            $table->unsignedBigInteger('taxppn_id');
            $table->foreign('taxppn_id')->references('id')->on('tax');
            $table->unsignedBigInteger('taxpph_id');
            $table->foreign('taxpph_id')->references('id')->on('tax');

            $table->string('npwp');

            $table->unsignedInteger('currency')->nullable();
            $table->foreign('currency')->references('id')->on('currency');
            
            $table->string('incoterms')->nullable();

            $table->string('transport');

            $table->unsignedBigInteger('certificate');
            // $table->foreign('certificate')->references('id')->on('certificate');
            
            $table->string('certnote');
            $table->text('volumenote');
            $table->text('qualitynote');
            $table->text('measurement');
            $table->text('document');

            $table->unsignedBigInteger('division_id')->comment('//division_id = id *tbl company');
            $table->foreign('division_id')->references('id')->on('company');
           
            $table->string('division')->comment('//division = code *tbl company');
            // $table->foreign('division')->references('id')->on('company');
           

            $table->float('dia_allowence')->nullable();
            $table->float('hei_allowence')->nullable();
            $table->float('wid_allowence')->nullable();
            $table->float('leng_allowence')->nullable();
            $table->text('detailnote')->nullable();
            $table->string('sellunit')->nullable();
            $table->string('teres')->nullable();
            $table->enum('is_delete',['1', '0'])->comment('0 = active / 1 = deleted')->default('0');
            $table->unsignedInteger('created_by');
            
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
        Schema::dropIfExists('po_transaction');
    }
}
