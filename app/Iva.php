<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Iva';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nomiva','valiva'];

    public $timestamps = false;
}
