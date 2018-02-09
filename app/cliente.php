<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $fillable = ['tipo_doc','num_doc','razon_social','direccion'];
}
