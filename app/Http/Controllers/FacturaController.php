<?php

namespace App\Http\Controllers;

use App;
use App\detalle_factura as detalle;
use App\empresa;
use App\factura;
use App\producto;
use App\Util;
use DateTime;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Ws\Services\SunatEndpoints;
use Illuminate\Http\Request;
use Response;

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

    public function generar_factura($factura_id)
    {     
        $util = new Util();  
        $empresa = empresa::getDatosEmpresa();
        $factura = factura::find($factura_id);        
        $detalles = detalle::where('factura_id', $factura_id)->get();
        // Venta
        $invoice = new Invoice();
        $invoice->setTipoDoc('01')
            ->setSerie($factura->serie)
            ->setCorrelativo($factura->correlativo)
            ->setFechaEmision($factura->created_at) //new DateTime() created_at
            ->setTipoMoneda($factura->tipo_moneda)
            ->setClient(Util::getClient($factura->cliente_id))
            ->setMtoOperGravadas($factura->monto_oper_gravadas)
            ->setMtoOperExoneradas($factura->monto_oper_exonerada)
            ->setMtoOperInafectas($factura->monto_oper_inafectada)
            ->setMtoIGV($factura->monto_igv)
            ->setMtoImpVenta($factura->monto_total_venta)
            ->setCompany(Util::getCompany());

        $items = [];
        foreach ($detalles as $det) {
            $item = new SaleDetail();
            $item->setCodProducto($det->producto->cod_producto)
                ->setUnidad($det->producto->unidad)
                ->setCantidad($det->cantidad)
                ->setDescripcion($det->producto->descripcion)
                ->setIgv(18)
                ->setTipAfeIgv('10')
                ->setMtoValorVenta($det->valor_venta)
                ->setMtoValorUnitario($det->valor_unitario)
                ->setMtoPrecioUnitario($det->precio_unitario);
            $items[] = $item;
        }

        //$letras = NumeroALetras::convertir($factura->monto_total_venta, 'soles', 'centimos');
        $legend = new Legend();
        $legend->setCode('1000') //NumeroALetras::convertir($factura->monto_total_venta
            ->setValue('SON 10 CON 00/100 SOLES');

        $invoice->setDetails($items)
            ->setLegends([$legend]);

       // Envio a SUNAT.        
        $see = $util->getSee(SunatEndpoints::FE_HOMOLOGACION);
        $res = $see->send($invoice);
        Util::writeCdr($invoice, $res->getCdrZip());

        $pdf = $util->getPdf($invoice);
        
        $util->showPdf($pdf, $invoice->getName() . '.pdf');

        Util::writeXml($invoice, $see->getFactory()->getLastXml());   
        $factura->estado_factura = "XML Generado";
$factura->save();

                    
    }

    public function pruebaf1()
    {
        $util = new Util();
        // Venta
        $invoice = new Invoice();
        $invoice
            ->setFecVencimiento(new DateTime())
            ->setTipoDoc('01')
            ->setSerie('FF11')
            ->setCorrelativo('29')
            ->setFechaEmision(new DateTime())
            ->setTipoMoneda('PEN')
            ->setClient($util->getClient())
            ->setMtoOperGravadas(100)
            ->setMtoOperExoneradas(0)
            ->setMtoOperInafectas(0)
            ->setMtoIGV(18)
            ->setMtoImpVenta(118)
            ->setCompany($util->getCompany());

        $item1 = new SaleDetail();
        $item1->setCodProducto('C023')
            ->setUnidad('NIU')
            ->setCantidad(2)
            ->setDescripcion('PROD 1')
            ->setDescuento(1)
            ->setIgv(18)
            ->setTipAfeIgv('10')
            ->setMtoValorVenta(100)
            ->setMtoValorUnitario(50)
            ->setMtoPrecioUnitario(59);

        $legend = new Legend();
        $legend->setCode('1000')
            ->setValue('SON DOS CIENTOS CON 00/100 SOLES');

        $invoice->setDetails([$item1])
            ->setLegends([$legend]);

        // Envio a SUNAT.
        $see = $util->getSee(SunatEndpoints::FE_HOMOLOGACION);

        $pdf = $util->getPdf($invoice);
        $util->showPdf($pdf, $invoice->getName() . '.pdf');

        Util::writeXml($invoice, $see->getFactory()->getLastXml());
    }

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
