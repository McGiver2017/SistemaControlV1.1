<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehiculo extends Model
{
    protected $fillable = ['placa','marca','num_certificado','config_vehicular'];

}
