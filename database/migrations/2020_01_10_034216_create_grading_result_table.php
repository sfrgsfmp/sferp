<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradingResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grading_result', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('sendgrader_id'); //foreign_key
            $table->foreign('sendgrader_id')->references('id')->on('sendgrader');

            $table->date('date')->comment('tgl per kegiatan (selama durasi dinas luar)');
            $table->string('tipebiaya'); //akomodasi, transport, operasional, lain-lain
            $table->text('keterangan')->comment('keterangan pengeluaran biaya untuk apa?'); //keterangan pengeluaran biaya
            $table->integer('biaya')->comment('biaya per keterangan'); //biaya per keterangan

            $table->string('nokendaraan');

            $table->integer('btg')->nullable();
            $table->float('m3')->nullable();
            $table->integer('harga/m3')->nullable();

            $table->integer('created_by')->comment('yg input grading-result');
            
            $table->enum('status', ['1', '2', '3', '4', '5'])->default('5')->comment('//1=Waiting, 2=Approved 3=Rejected, 4=Revisi, 5=Created');
            
            $table->unsignedInteger('approval_statusby')->comment('//siapa yg menyetujui/menolak')->nullable();
            $table->foreign('approval_statusby')->references('id')->on('users');

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
        Schema::dropIfExists('grading_result');
    }
}
