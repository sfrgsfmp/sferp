<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoborderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joborder', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_jo')->unique();
            $table->string('jo');
            $table->date('applydate');
            $table->string('division');
            $table->unsignedBigInteger('itemgroup_id');
            $table->foreign('itemgroup_id')->references('id')->on('itemgroup');

            // $table->unsignedBigInteger('objective');
            // $table->foreign('objective')->references('id')->on('objective');
            $table->unsignedBigInteger('pimid');
            $table->foreign('pimid')->references('id')->on('pim');
            $table->float('estdocm3');
            $table->string('tuk');
            $table->unsignedBigInteger('whgrade');
            $table->foreign('whgrade')->references('id')->on('warehouse');
            $table->unsignedBigInteger('whsimpan');
            $table->foreign('whsimpan')->references('id')->on('warehouse');
            $table->unsignedBigInteger('whtahan');
            $table->foreign('whtahan')->references('id')->on('warehouse');
            $table->text('instruksilain');
            $table->string('identitas');
            $table->float('tebalfisik')->nullable();
            $table->float('lebarfisik')->nullable();
            $table->float('panjangfisik')->nullable();
            $table->text('descfisik')->nullable();
            $table->float('tebalbeli')->nullable();
            $table->float('lebarbeli')->nullable();
            $table->float('panjangbeli')->nullable();
            $table->text('descbeli')->nullable();
            $table->float('tebalinvoice')->nullable();
            $table->float('lebarinvoice')->nullable();
            $table->float('panjanginvoice')->nullable();
            $table->text('descinvoice')->nullable();

            $table->unsignedInteger('seratmiring')->nullable();
            $table->foreign('seratmiring')->references('id')->on('quality');
            $table->unsignedInteger('seratputus')->nullable();
            $table->foreign('seratputus')->references('id')->on('quality');
            $table->unsignedInteger('bengkoklebar')->nullable();
            $table->foreign('bengkoklebar')->references('id')->on('quality');
            $table->unsignedInteger('bengkoktebal')->nullable();
            $table->foreign('bengkoktebal')->references('id')->on('quality');
            $table->unsignedInteger('gelombanglebar')->nullable();
            $table->foreign('gelombanglebar')->references('id')->on('quality');
            $table->unsignedInteger('gelombangtebal')->nullable();
            $table->foreign('gelombangtebal')->references('id')->on('quality');
            $table->unsignedInteger('twist')->nullable();
            $table->foreign('twist')->references('id')->on('quality');
            $table->unsignedInteger('warnagelap')->nullable();
            $table->foreign('warnagelap')->references('id')->on('quality');
            $table->unsignedInteger('stain')->nullable();
            $table->foreign('stain')->references('id')->on('quality');
            $table->unsignedInteger('taliair')->nullable();
            $table->foreign('taliair')->references('id')->on('quality');
            $table->unsignedInteger('busuk')->nullable();
            $table->foreign('busuk')->references('id')->on('quality');
            $table->unsignedInteger('pecahpermukaan')->nullable();
            $table->foreign('pecahpermukaan')->references('id')->on('quality');
            $table->unsignedInteger('pecahujung')->nullable();
            $table->foreign('pecahujung')->references('id')->on('quality');
            $table->unsignedInteger('retak')->nullable();
            $table->foreign('retak')->references('id')->on('quality');
            $table->unsignedInteger('matamati')->nullable();
            $table->foreign('matamati')->references('id')->on('quality');
            $table->unsignedInteger('kulittumbuh')->nullable();
            $table->foreign('kulittumbuh')->references('id')->on('quality');
            $table->unsignedInteger('pinholes')->nullable();
            $table->foreign('pinholes')->references('id')->on('quality');
            $table->unsignedInteger('doreng')->nullable();
            $table->foreign('doreng')->references('id')->on('quality');
            $table->unsignedInteger('warnaterang')->nullable();
            $table->foreign('warnaterang')->references('id')->on('quality');
            $table->unsignedInteger('kayumuda')->nullable();
            $table->foreign('kayumuda')->references('id')->on('quality');
            $table->unsignedInteger('kukumacan')->nullable();
            $table->foreign('kukumacan')->references('id')->on('quality');
            $table->unsignedInteger('sisibaik')->nullable();
            $table->foreign('sisibaik')->references('id')->on('quality');
            $table->unsignedInteger('h2b')->nullable();
            $table->foreign('h2b')->references('id')->on('quality');
            $table->unsignedInteger('h2k')->nullable();
            $table->foreign('h2k')->references('id')->on('quality');
            $table->unsignedInteger('gubalsisiorder')->nullable();
            $table->foreign('gubalsisiorder')->references('id')->on('quality');
            $table->unsignedInteger('gubalsisinonorder')->nullable();
            $table->foreign('gubalsisinonorder')->references('id')->on('quality');
            $table->unsignedInteger('cacatring')->nullable();
            $table->foreign('cacatring')->references('id')->on('quality');
            $table->unsignedInteger('kualitas')->nullable();
            $table->foreign('kualitas')->references('id')->on('quality');

            $table->enum('is_delete',['1','0'])->default('0');
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
        Schema::dropIfExists('joborder');
    }
}
