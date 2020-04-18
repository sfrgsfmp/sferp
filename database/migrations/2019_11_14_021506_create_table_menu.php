<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMenu extends Migration
{
    
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id_menu');
            $table->string('menu_name');
            $table->string('link_menu');
            $table->string('icon');
            $table->string('id_dept');
            $table->foreign('id_dept')->references('id_dept')->on('departemen');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
