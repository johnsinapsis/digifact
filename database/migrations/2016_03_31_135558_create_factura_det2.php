<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaDet2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_det2',function(Blueprint $table){ 
            $table->integer('numfac'); 
            $table->integer('id_resol')->unsigned()->nullable();
            $table->integer('idprod');
            $table->primary(array('numfac', 'id_resol','idprod'));
            $table->integer('cantprod');
            $table->decimal('valprod');
            $table->foreign('numfac')->references(array('numfac', 'id_resol'))->on('factura_cab');
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
        Schema::drop('factura_det2');
    }
}
