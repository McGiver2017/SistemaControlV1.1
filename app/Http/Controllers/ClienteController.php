<?php

namespace App\Http\Controllers;

use App\cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return cliente::orderBy('id', 'DESC')->get();
    }

    public function getclientelist(){  
        $productos = cliente::orderBy('id', 'DESC')->get();
        $salida = [];
        foreach($productos as $producto){
            $salida[] = ['value' => $producto->id,'text' => $producto->num_doc." : ".$producto->razon_social,'direccion'=>$producto->direccion];
        }
        return $salida;
    }
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
        $ruc = cliente::where('num_doc', $request->ruc)->get();
        if (count($ruc) == 0) {
            $registro = cliente::create($request->all());
            if ($registro) {
                return 'Registrado';
            } else {
                return 'Ah ocurrido un error';
            }
        } else {
            return 'No se Registro';
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return cliente::find($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $registro = cliente::updateOrCreate(['id' => $id], $request->all());
        if ($registro) {
            return 'Actualizado';
        } else {
            return 'Ah ocurrido un error';
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = cliente::destroy($id);
        if ($delete) {
            return 'Eliminado';
        } else {
            return 'Ah ocurrido un error';
        }

    }
}
