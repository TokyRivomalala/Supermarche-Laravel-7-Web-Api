<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockarticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('stockarticles', function (Blueprint $table) {
            $table->string('idarticle',30);
            $table->double('quantitestock');
            $table->double('prixunitaire');
            $table->timestamps();

            $table->foreign('idarticle')
                ->references('idarticle')
                ->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stockarticles');
    }
}
