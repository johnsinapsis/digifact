<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaDet2 extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'factura_det2';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['numfac', 'id_resol','idprod', 'cantprod','valprod','valiva'];
    public $timestamps = false;
}
