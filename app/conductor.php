<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class conductor extends Model
{
    protected $fillable = ['dni','nombre','apellido','brevete','estado'];

}
