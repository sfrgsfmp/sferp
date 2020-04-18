<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('address');

            $table->string('country');

            $table->char('province_id',2)->nullable();
            $table->foreign('province_id')->references('id')->on('indonesia_provinces');

            $table->char('city_id', 4)->nullable();
            $table->foreign('city_id')->references('id')->on('indonesia_cities');
            
            $table->string('postal')->nullable();
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->string('website');
            $table->string('logo');
            $table->string('npwp')->nullable();
            $table->string('type')->nullable();
            $table->string('loadingport');
            $table->text('desc');
            $table->string('contact_person');
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
        Schema::dropIfExists('company');
    }
}
