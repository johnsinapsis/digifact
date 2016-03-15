<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'productos';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['COD_PRO', 'NOM_PRO', 'EST_PRO','TIP_PRO','ABBR'];

    public $timestamps = false;
}
