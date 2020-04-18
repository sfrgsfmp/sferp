<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemgroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemgroup', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('itemgroup_code')->unique();
            $table->string('itemgroup_name');
            
            $table->timestamps();
            $table->enum('is_delete', ['1', '0'])->default(0)->comment('1 delete, 0 active'); //1 delete, 0 active
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itemgroup');
    }
}
