<?php

namespace App\Http\Controllers;

use App\detalletransporte;
use App\transporte;
use Illuminate\Http\Request;

class DetalletransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $registro = detalletransporte::create($request->all());
        if ($registro) {
            $transporte = transporte::find($request->transporte_id);
            $transporte->egresos = $transporte->egresos + $request->monto;
            $transporte->save();
            return 'Registrado';
        } else {
            return 'Ah ocurrido un error';
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\detalletransporte  $detalletransporte
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datos = detalletransporte::where('transporte_id', $id)->get();
        return $datos;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\detalletransporte  $detalletransporte
     * @return \Illuminate\Http\Response
     */
    public function edit(detalletransporte $detalletransporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\detalletransporte  $detalletransporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, detalletransporte $detalletransporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\detalletransporte  $detalletransporte
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = detalletransporte::destroy($id);
        if ($delete) {
            return 'Eliminado';
        } else {
            return 'Ah ocurrido un error';
        }

    }
}
