<?php
namespace App\Http\Controllers;

use App\caja;
use DateTime;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return caja::get();
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

        $cajas = caja::get();
        $aprovado = true;
        foreach ($cajas as $caja) {
            if ($caja->estado == "Abierto") {
                $aprovado = false;
                break;
            }
        }
        if ($aprovado) {
            $fApertura = new DateTime($request->transporte['fecha_apertura']);
            $fCierre = new DateTime($request->transporte['fecha_cierre']);
            $cajanew = new caja;
            $cajanew->descripcion = $request->descripcion;
            $cajanew->fecha_apertura = $fApertura;
            $cajanew->fecha_cierre = $fCierre;
            $cajanew->monto = $request->monto;
            $registro = $cajanew->save();
            if ($registro) {
                return 'Registrado';
            } else {
                return 'Ah ocurrido un error';
            }
        } else {
            return 'caja abierta';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $caja = caja::find($id);
        return $caja;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function edit(caja $caja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, caja $caja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\caja  $caja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $caja = caja::find($id);
        $caja->estado = "Cerrado";
        $delete = $caja->save();
        if ($delete) {
            return 'Eliminado';
        } else {
            return 'Ah ocurrido un error';
        }
    }
}
