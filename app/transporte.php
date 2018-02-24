<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transporte extends Model
{
    public function vehiculo(){
        return $this->belongsTo('App\vehiculo');
    }
    public function conductor(){      
        return $this->belongsTo("App\conductor");
    }
}
