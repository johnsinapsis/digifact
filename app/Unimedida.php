<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unimedida extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'par_unimedida';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'abr'];

    public $timestamps = false;
}
