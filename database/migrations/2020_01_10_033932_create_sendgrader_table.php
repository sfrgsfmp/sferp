<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendgraderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sendgrader', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('noipl');
            $table->foreign('noipl')->references('noipl')->on('ipl');

            $table->unsignedInteger('grader_id');
            $table->foreign('grader_id')->references('id')->on('users');

            $table->string('keperluan');

            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('vendor');

            $table->integer('uang_dinas');

            $table->date('start_date');
            $table->date('end_date');
            $table->string('bank');
            $table->string('rekening',50);

            $table->string('surat_perintah')->nullable();

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
        Schema::dropIfExists('sendgrader');
    }
}
