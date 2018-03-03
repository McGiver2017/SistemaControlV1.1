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
        'seriefactura1' => 'FA001',
        'seriefactura2' => 'FA002',
        'origenfactura1' => '1',
        'origenfactura2' => '1',
        'origenguia' => '1',
        'serieguia' => 'T001',
        'origenboleta' => '100',
        'ubigeo'=> '250107'
    ];
    }
}
