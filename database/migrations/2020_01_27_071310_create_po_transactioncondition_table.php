<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoTransactionconditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_transactioncondition', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_po');
            $table->float('trucking');
            $table->string('unit_trucking');
            $table->float('sort_min');
            $table->float('sort_max');
            $table->float('dia_min');
            $table->float('dia_max');
            $table->float('length_min');
            $table->float('length_max');
            $table->float('M3_min');
            $table->float('M3_max');
            $table->float('dia_value_min');
            $table->float('dia_value_max');
            $table->float('length_value_min');
            $table->float('length_value_max');
            $table->string('value_type');
            $table->float('value');
            $table->enum('is_delete',['1', '0'])->comment('0 = active / 1 = deleted')->default('0');
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
        Schema::dropIfExists('po_transactioncondition');
    }
}
