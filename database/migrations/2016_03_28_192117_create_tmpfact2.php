<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpfact2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmpfact2',function(Blueprint $table){
            $table->increments('id');
            $table->integer('idprod');
            $table->integer('cantprod');
            $table->decimal('valprod');
            $table->decimal('valiva');
            $table->foreign('idprod')->references('COD_PRO')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tmpfact2');
    }
}
