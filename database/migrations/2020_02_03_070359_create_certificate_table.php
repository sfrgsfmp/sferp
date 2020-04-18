<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cert_code')->unique();
            $table->string('cert_name');
            $table->enum('is_delete', ['0', '1'])->default('0');
            $table->string('kode_fsc');
            $table->string('legend');
            $table->unsignedBigInteger('wwf_id');
            $table->foreign('wwf_id')->references('id')->on('wwf');

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
        Schema::dropIfExists('certificate');
    }
}
