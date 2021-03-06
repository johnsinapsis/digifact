<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos',function(Blueprint $table){
            $table->increments('id');
            $table->date('fecpago');
            $table->integer('numfac');
            $table->integer('id_resol')->unsigned()->nullable();
            $table->float('valpago');
            $table->integer('tipopago')->unsigned();
            $table->integer('user')->unsigned();
            $table->timestamps();
            $table->foreign('numfac')->references(array('numfac', 'id_resol'))->on('factura_cab');
            $table->foreign('tipopago')->references('id')->on('tipo_pago')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pagos');
    }
}
