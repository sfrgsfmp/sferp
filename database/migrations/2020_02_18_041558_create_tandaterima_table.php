<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTandaterimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tandaterima', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_tt');
            $table->string('tt_no');
            $table->string('form_no');
            $table->date('tt_date');
            $table->string('division');
            $table->unsignedBigInteger('itemgroup_id');
            $table->foreign('itemgroup_id')->references('id')->on('itemgroup');
            $table->unsignedBigInteger('pimid');
            $table->foreign('pimid')->references('id')->on('pim');
            $table->string('sj_no')->nullable();
            $table->string('dkp_no')->nullable();
            $table->date('doc_dt')->nullable();
            $table->string('code_document')->nullable();
            $table->string('no_document')->nullable();
            $table->string('doc_no')->nullable();
            $table->string('cert_claim')->nullable();
            // $table->unsignedBigInteger('wwf_type');
            // $table->foreign('wwf_type')->references('id')->on('wwf');
            $table->string('code_concession')->nullable();
            $table->string('name_concession')->nullable();
            $table->string('grade_qty')->nullable();
            $table->string('phisic_qty')->nullable();
            $table->string('doc_qty')->nullable();
            $table->string('docm3')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('length')->nullable();

            $table->char('province',2)->nullable();
            $table->foreign('province')->references('id')->on('indonesia_provinces');
           
            $table->char('city',4)->nullable();
            $table->foreign('city')->references('id')->on('indonesia_cities');
            
            $table->char('district',7)->nullable();
            $table->foreign('district')->references('id')->on('indonesia_districts');

            $table->char('village',10)->nullable();
            $table->foreign('village')->references('id')->on('indonesia_villages');

            $table->date('grade_dt');
            $table->string('dari');
            $table->text('keterangan')->nullable();
            $table->string('no_spb')->nullable();
            $table->date('paydate');
            $table->date('dischargedate');
            $table->string('no_dokumen')->nullable();
            $table->string('jenis')->nullable();
            $table->string('tipe')->nullable();
            $table->string('btg')->nullable();
            $table->string('m3')->nullable();
            
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
        Schema::dropIfExists('tandaterima');
    }
}
