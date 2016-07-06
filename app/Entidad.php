<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entidades';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['COD_ENT', 'NOM_ENT', 'PAI_ENT','DEP_ENT','CIU_ENT','DIR_ENT','TEL_ENT','CEL_ENT','CON_ENT','EST_ENT','VEN_ENT'];

    public $timestamps = false;

}
