<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_vendor');
            $table->text('address')->nullable();
            
            $table->char('province_id',2)->nullable();
            $table->foreign('province_id')->references('id')->on('indonesia_provinces');
            // $table->foreign('province_id')->references('province_id')->on('kbm');

            $table->char('city_id', 4)->nullable();
            $table->foreign('city_id')->references('id')->on('indonesia_cities');

            $table->integer('postalcode')->nullable();
            $table->string('portofloading')->nullable();
            
            $table->string('phone', 12)->nullable();
            $table->string('fax', 12)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            $table->unsignedBigInteger('bankaccount_id')->nullable();
            $table->foreign('bankaccount_id')->references('id')->on('bank_account');


            $table->string('type_vendor');
            // $table->unsignedBigInteger('type_vendor_id');
            // $table->foreign('type_vendor_id')->references('id')->on('group_vendor');
            // $table->unsignedBigInteger('kph_id')->nullable();
            // $table->foreign('kph_id')->references('id')->on('kph');
            

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
        Schema::dropIfExists('vendor');
    }
}
