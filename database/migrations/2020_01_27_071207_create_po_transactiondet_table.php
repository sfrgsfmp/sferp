<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoTransactiondetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_transactiondet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_po');
            // $table->foreign('code_po')->references('code')->on('po_transaction');
            $table->unsignedBigInteger('species_id');
            $table->foreign('species_id')->references('id')->on('species');
            
            $table->unsignedBigInteger('spec1_id')->nullable();
            $table->foreign('spec1_id')->references('id')->on('specification');

            $table->unsignedBigInteger('spec2_id')->nullable();
            $table->foreign('spec2_id')->references('id')->on('specification');

            $table->string('sortimen')->nullable();
            $table->unsignedInteger('quality_id')->nullable();
            $table->foreign('quality_id')->references('id')->on('quality');

            $table->float('price')->default('0')->nullable();
            $table->float('charge')->default('0')->nullable();
            $table->float('discount')->comment('in %')->default('0')->nullable();
            $table->float('totalprice_det')->default('0')->nullable();
            $table->text('komposisi_desc')->nullable();
            $table->text('komposisipjg_desc')->nullable();

            $table->float('cuttdia_min')->nullable();
            $table->float('cuttdia_max')->nullable();
            $table->float('invdia_min')->nullable();
            $table->float('invdia_max')->nullable();
            $table->float('cuttheight_min')->nullable();
            $table->float('cuttheight_max')->nullable();
            $table->float('invheight_min')->nullable();
            $table->float('invheight_max')->nullable();
            $table->float('cuttwidth_min')->nullable();
            $table->float('cuttwidth_max')->nullable();
            $table->float('invwidth_min')->nullable();
            $table->float('invwidth_max')->nullable();
            $table->float('cuttlength_min')->nullable();
            $table->float('cuttlength_max')->nullable();
            $table->float('invlength_min')->nullable();
            $table->float('invlength_max')->nullable();
            $table->float('m3')->nullable();
            $table->text('mutukayu_desc')->nullable();
            $table->text('statuskayu_desc')->nullable();
            $table->enum('is_delete',['1', '0'])->comment('0 = active / 1 = deleted')->default('0');
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
        Schema::dropIfExists('po_transactiondet');
    }
}
