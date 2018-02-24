<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empresa extends Model
{
    public static function getDatosEmpresa(){
        return [
        'ruc' => '20394061361',
        'razon_social' => 'GRUPO CORPORATIVO ALANIA S.A.C..',
        'nombre_comercial' => '-',
        'direccion' => 'JR. TUPAC AMARU MZA. C LOTE. 18',
        'certificado' => '20394061361Cert.pem',
        'origenfactura' => '42',
        'origenguia' => '42',
        'origenboleta' => '100',
        'ubigeo'=> '250107'
    ];
    }
}
