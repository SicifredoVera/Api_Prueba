<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoempleado extends Model
{
     protected $table = 'tipoempleado';
    public $timestamps= false;
    protected $fillable = [
        'descripcion',
    ];
}
