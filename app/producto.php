<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
     protected $fillable = ['cod_producto','descripcion',
        'unidad'];
}
