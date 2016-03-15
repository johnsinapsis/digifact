<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaDet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_det',function(Blueprint $table){ 
            $table->integer('numfac'); 
            $table->integer('id_resol')->unsigned()->nullable();
            $table->integer('idserv');
            $table->primary(array('numfac', 'id_resol','idserv'));
            $table->integer('cantserv');
            $table->decimal('valserv');
            $table->foreign('numfac')->references(array('numfac', 'id_resol'))->on('factura_cab');
            $table->foreign('idserv')->references('COD_SER')->on('servicios');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('factura_det');
    }
}
