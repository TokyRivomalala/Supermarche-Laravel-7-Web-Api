<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGratuitpourcentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gratuitpourcentages', function (Blueprint $table) {
            $table->string('idgratuitpourcentage',30)->primary();
            $table->integer('nbminprc');
            $table->double('prc');
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
        Schema::dropIfExists('gratuitpourcentages');
    }
}
