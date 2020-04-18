<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiptlog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->unsignedBigInteger('pimid');
            $table->foreign('pimid')->references('id')->on('pim');
            $table->string('status');
            $table->unsignedBigInteger('itemgroup_id');
            $table->foreign('itemgroup_id')->references('id')->on('itemgroup');
            $table->string('division');
            $table->date('applydate');
            
            $table->unsignedBigInteger('from_warehouse');
            $table->foreign('from_warehouse')->references('id')->on('warehouse');
            $table->unsignedBigInteger('to_warehouse')->nullable();
            $table->foreign('to_warehouse')->references('id')->on('warehouse');

            $table->unsignedBigInteger('objective');
            $table->foreign('objective')->references('id')->on('objective');

            $table->string('ppc');
            $table->string('remarks');
            $table->string('perni');
            $table->string('fakb');

            $table->unsignedInteger('unitsize');
            $table->foreign('unitsize')->references('id')->on('measurement');
            $table->unsignedInteger('unitprice');
            $table->foreign('unitprice')->references('id')->on('measurement');
            $table->enum('is_delete', ['0', '1'])->comment('1 delete')->default('0');
            
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
        Schema::dropIfExists('receiptlog');
    }
}
