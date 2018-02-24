<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalletransporte extends Model
{
    protected $fillable = ['transporte_id','num_doc','descripcion','monto'];
}
