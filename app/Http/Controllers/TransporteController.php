<?php

namespace App\Http\Controllers;

use App\transporte;
use Illuminate\Http\Request;

class TransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transportes = transporte::get();
        $data = [];
        foreach ($transportes as $transporte) {
            $item = [
                'id' => $transporte->id,
                'fecha_envio' => $transporte->fecha_envio,
                'estado' => $transporte->estado,
                'conductor' => $transporte->conductor->nombre . " " . $transporte->conductor->apellido,
                'vehiculo' => $transporte->vehiculo->placa . " " . $transporte->vehiculo->marca,
                'ingresos' => $transporte->ingresos,
                'egresos' => $transporte->egresos,
            ];
            $data[] = $item;
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transporte = transporte::find($id);
        $item = [
            'id' => $transporte->id,
            'fecha_envio' => $transporte->fecha_envio,
            'estado' => $transporte->estado,
            'conductor' => $transporte->conductor->nombre . " " . $transporte->conductor->apellido,
            'vehiculo' => $transporte->vehiculo->placa . " " . $transporte->vehiculo->marca,
            'ingresos' => $transporte->ingresos,
            'egresos' => $transporte->egresos,
        ];

        return $item;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function edit(transporte $transporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transporte $transporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\transporte  $transporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(transporte $transporte)
    {
        //
    }
}
