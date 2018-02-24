<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UsuarioResource extends ResourceCollection
{
    public $dato = null;
    public function __construct($dato)
    {
        $this->dato = $dato;
    }
    public function toArray($request)
    {
        return [
            'id' => $this->dato->id,
            'alias' => $this->dato->alias,
            'email' => $this->dato->email,
            'created_at' => $this->dato->created_at,
            'updated_at' => $this->dato->updated_at,
        ];
    }
}
