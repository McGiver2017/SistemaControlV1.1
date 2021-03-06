<?php

namespace App\Http\Controllers;

use App\producto as tabla;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        return tabla::orderBy('id', 'DESC')->get();
    }

    public function getproductolist(){  
        $productos = tabla::orderBy('id', 'DESC')->get();
        $salida = [];
        foreach($productos as $producto){
            $salida[] = ['value' => $producto->cod_producto,'text' => $producto->descripcion];
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
        $ruc = tabla::where('cod_producto', $request->ruc)->get();
        if (count($ruc) == 0) {
            $registro = tabla::create($request->all());
            if ($registro) {
                return 'Registrado';
            } else {
                return 'Ah ocurrido un error';
            }
        } else {
            return 'No se Registro';
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return tabla::find($id)->first();

    }

   
    public function update(Request $request, $id)
    {
        $registro = tabla::updateOrCreate(['id' => $id], $request->all());
        if ($registro) {
            return 'Actualizado';
        } else {
            return 'Ah ocurrido un error';
        }

    }

    
    public function destroy($id)
    {
        $delete = tabla::destroy($id);
        if ($delete) {
            return 'Eliminado';
        } else {
            return 'Ah ocurrido un error';
        }

    }
}
