<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIplTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('ipl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('noipl')->unique();
            $table->date('transaction_date');

            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendor');
            $table->unsignedBigInteger('species_id');
            $table->foreign('species_id')->references('id')->on('species');
            $table->string('sortimen');

            $table->float('diameter_from')->nullable();
            $table->float('diameter_to')->nullable();
            $table->string('uom_diameter')->nullable();
            $table->float('length_from')->nullable();
            $table->float('length_to')->nullable();
            $table->string('uom_length')->nullable();
            $table->float('width_from')->nullable();
            $table->float('width_to')->nullable();
            $table->string('uom_width')->nullable();
            $table->float('thick_from')->nullable();
            $table->float('thick_to')->nullable();
            $table->string('uom_thick')->nullable();

            $table->string('status')->nullable();
            $table->string('quality')->nullable();
            $table->string('kwt')->nullable();
            $table->string('wood_drying')->nullable();
            $table->string('schema')->nullable();

            $table->float('volume');
            $table->string('uom_volume');

            $table->integer('approvalto_id')->length(10);
            // $table->foreign('approvalto_id')->references('id')->on('users');
            
            $table->enum('status_approval', ['1', '2', '3', '4', '5'])->default('1')->comment('//1=Created, 2=WaitingApproval 3=Approved, 4=Rejected, 5=Revisi'); //1=Created, 2=WaitingApproval 3=Approved, 4=Rejected, 5=Revisi
            
            $table->bigInteger('createdby_id');
            // $table->foreign('createdby_id')->references('id')->on('users');

            $table->enum('send_approval', ['1', '2'])->default('1')->comment('1=notyet, 2=done');

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
        Schema::dropIfExists('ipl');
    }
}
