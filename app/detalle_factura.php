<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalle_factura extends Model
{
     public function producto(){
        return $this->belongsTo('App\producto');
    }
}
