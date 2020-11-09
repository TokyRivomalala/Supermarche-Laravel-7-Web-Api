<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remises', function (Blueprint $table) {
            $table->string('idarticle',30);
            $table->string('idpourcentage',30);
            $table->string('idgratuit',30);
            $table->string('idgratuitpourcentage',30);
            $table->timestamps();

            $table->foreign('idarticle')
                ->references('idarticle')
                ->on('articles');
            
            $table->foreign('idpourcentage')
                ->references('idpourcentage')
                ->on('pourcentages');

            $table->foreign('idgratuit')
                ->references('idgratuit')
                ->on('gratuits');
            
 
            $table->foreign('idgratuitpourcentage')
                ->references('idgratuitpourcentage')
                ->on('gratuitpourcentages');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remises');
    }
}
