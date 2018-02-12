<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\factura;
use Response;
use App\Util;
use DateTime;
use App;
use App\cliente;
use App\detalle_factura as detalle;
use App\producto;
use App\user as usuario;
use App\empresa;
use NumeroALetras;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return factura::get();
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
       
        $Cfactura = factura::get();
        $empresa = empresa::getDatosEmpresa();
        $Origenemp = $empresa['origenfactura'];

//factura
        $factura = new factura;
        $factura->cliente_id = $request->num_doc;
        $factura->monto_oper_gravadas = $request->gravada;
        $factura->monto_total_venta = $request->total;
        $factura->monto_igv = $request->igv;
        $factura->fecha_emision = new DateTime();
        $factura->correlativo = $Origenemp + count($Cfactura) + 1;

        $data = $factura->save();
        foreach ($request->productos as $Jproducto) {
            //producto
                $detalle = new detalle;
                $detalle->cantidad = $Jproducto["cantidad"];
                $detalle->precio_unitario = $Jproducto["costo"];
                $detalle->valor_unitario = $Jproducto["costo"];
                $detalle->valor_venta = $Jproducto["cantidad"] * $Jproducto["costo"];
                $detalle->factura_id = $factura->id;
                $detalle->producto_id = $Jproducto['codigo'];
                $data1 = $detalle->save(); 
        }

        if ($data1 && $data) {
           return 'proceso_finalizado';
        } else {
            return 'ocurrio un error';
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(factura $factura)
    {
        //
    }
}
