<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'precios';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['COD_PRO', 'COD_ENT', 'VAL_PRO','VAL_IVA'];

    public $timestamps = false;
}
