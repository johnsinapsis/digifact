<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'servicios';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['COD_SER', 'NOM_SER', 'EST_SER','TIP_SER','ABBR'];

    public $timestamps = false;
}
