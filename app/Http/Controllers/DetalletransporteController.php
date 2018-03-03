<?php

namespace App\Http\Controllers;

use App\detalletransporte;
use App\transporte;
use App\balance;
use App\caja;
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
        $transporte = transporte::find($request->transporte_id);
        if ( $transporte->ingresos == $transporte->egresos ){
            $registro = detalletransporte::create($request->all());
            $registro->tipo_declaracion = "Exceso";
            $registro->save();
            $transporte->exceso = $transporte->exceso + $request->monto;
            $transporte->save();
            $balance = balance::find($transporte->balance_id);
            //crear nuevo balance
            $caja = caja::where('estado', 'Abierto')->first();
            //
            $balancenew = new balance;
            $balancenew->tipo = 'egreso';
            $balancenew->caja_id = $caja->id;
            $balancenew->monto = $request->monto;
            $balancenew->saldo_caja = $caja->monto;
            $balancenew->saldo_final = $caja->monto - $request->monto;
            $balancenew->tipo_responsable = "vehiculo";
            $balancenew->responsable = $balance->responsable;
            $balancenew->tipo_documento = "Otros";
            $balancenew->numero_documento = "Transporte id: ".$transporte->id." Exceso";
            $balancenew->monto_declarado = $request->monto;
            $balancenew->estado = "Egreso declarado"; 
            $balancenew->save();
            $caja->monto = $balancenew->saldo_final;
            $caja->save();
            return 'Exceso';
        }
        else{
            $registro = detalletransporte::create($request->all());
            if ($registro) {
                
                $transporte->egresos = $transporte->egresos + $request->monto;
                $transporte->save();
                $balance = balance::find($transporte->balance_id);
                $balance->monto_declarado = $transporte->egresos;
                if ( $transporte->ingresos == $transporte->egresos ){
                    $balance->estado = "Egreso declarado";
                }
                $balance->save();
                return 'Registrado';
            } else {
                return 'Ah ocurrido un error';
            }
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
        $detalletransporte = detalletransporte::find($id);
        $transporte = transporte::find($detalletransporte->transporte_id);
        if ( $detalletransporte->tipo_declaracion == "Exceso")
        {
            $transporte->exceso = $transporte->exceso - $detalletransporte->monto;
            $transporte->save();
            $balance = balance::find($transporte->balance_id);
            //crear nuevo balance
            $caja = caja::where('estado', 'Abierto')->first();
            //
            $balancenew = new balance;
            $balancenew->tipo = 'ingreso';
            $balancenew->caja_id = $caja->id;
            $balancenew->monto = $detalletransporte->monto;
            $balancenew->saldo_caja = $caja->monto;
            $balancenew->saldo_final = $caja->monto + $detalletransporte->monto;
            $balancenew->tipo_responsable = "vehiculo";
            $balancenew->responsable = $balance->responsable;
            $balancenew->tipo_documento = "Otros";
            $balancenew->numero_documento = "Elimando Exceso de ".$transporte->id;
            $balancenew->monto_declarado = $detalletransporte->monto;
            $balancenew->estado = "Ingreso declarado"; 
            $balancenew->save();
            $caja->monto = $balancenew->saldo_final;
            $caja->save();
        }
        else
        {           
            $transporte->egresos = $transporte->egresos - $detalletransporte->monto;
            $transporte->save();
            $balance = balance::find($transporte->balance_id);
            $balance->monto_declarado = $transporte->egresos;  
            $balance->estado = "Egreso no declarado";          
            $balance->save();
        }
        $delete = detalletransporte::destroy($id);
        if ($delete) {
            
            return 'Eliminado';
        } else {
            return 'Ah ocurrido un error';
        }

    }
}
