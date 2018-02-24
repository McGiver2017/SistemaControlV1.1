<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class caja extends Model
{
    protected $fillable = ['descripcion','fecha_apertura','fecha_cierre','monto'];
}
