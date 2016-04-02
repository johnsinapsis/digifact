<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tmpfact2 extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tmpfact2';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['idprod', 'cantprod','valprod','valiva'];
    public $timestamps = false;
}
