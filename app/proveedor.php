<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    
    protected $fillable = ['ruc','razon_social','direccion'];
}
