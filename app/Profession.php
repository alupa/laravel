<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    //protected $table = 'my_professions'; por si la tabla en la BD es distinta al model
    //public $timestamps = false; por si no quiero trabajar con timestamps
    protected $fillable = ['title'];
}
