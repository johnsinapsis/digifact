<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabrica extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'prod_insumo';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['idprod', 'idinsumo'];

    public $timestamps = false;
}
