<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
     protected $table = 'empleado';
    public $timestamps= false;
    protected $fillable = [
        'nombre','apellido','cedula','tipoempleadoid',
    ];
}
