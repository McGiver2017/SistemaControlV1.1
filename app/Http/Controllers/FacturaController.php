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
        $gravada = 0;
        $exonerada = 0;
        $inafecta = 0;
        $factura = new factura;
        $factura->cliente_id = $request->num_doc;
        $factura->fecha_emision = new DateTime();
        $factura->correlativo = $Origenemp + count($Cfactura) + 1;
        $factura->monto_oper_gravadas = $gravada;
        $factura->monto_oper_exonerada = $exonerada;
        $factura->monto_oper_inafectada = $inafecta;
        $factura->monto_igv = $gravada * 0.18;
        $factura->monto_total_venta = $gravada + $exonerada + $inafecta + $factura->monto_igv;

        $factura->save();

        foreach ($request->productos as $Jproducto) {
            //producto
            $variable = $Jproducto["tip_afe_igv"];
            switch ($variable) {
                case '10':
                    $detalle = new detalle;
                    $detalle->cantidad = $Jproducto["cantidad"];
                    $detalle->precio_unitario = $Jproducto["costo"];
                    $detalle->valor_unitario = $Jproducto["costo"] / 1.18;
                    $detalle->igv = $Jproducto["igv"];
                    $detalle->valor_venta = $Jproducto["cantidad"] * $detalle->valor_unitario;
                    $detalle->factura_id = $factura->id;
                    $detalle->producto_id = $Jproducto['codigo'];
                    $detalle->tip_afe_igv = $variable;
                    $gravada = $detalle->valor_venta + $gravada;
                    $data1 = $detalle->save();
                    break;

                case '20':
                    $detalle = new detalle;
                    $detalle->cantidad = $Jproducto["cantidad"];
                    $detalle->precio_unitario = $Jproducto["costo"];
                    $detalle->valor_unitario = $Jproducto["costo"];
                    $detalle->igv = $Jproducto["igv"];
                    $detalle->valor_venta = $Jproducto["cantidad"] * $Jproducto["costo"];
                    $detalle->factura_id = $factura->id;
                    $detalle->producto_id = $Jproducto['codigo'];
                    $detalle->tip_afe_igv = $variable;
                    $exonerada = $detalle->valor_venta + $exonerada;
                    $data1 = $detalle->save();
                    break;
                case '30':
                    $detalle = new detalle;
                    $detalle->cantidad = $Jproducto["cantidad"];
                    $detalle->precio_unitario = $Jproducto["costo"];
                    $detalle->valor_unitario = $Jproducto["costo"];
                    $detalle->valor_venta = $Jproducto["cantidad"] * $Jproducto["costo"];
                    $detalle->factura_id = $factura->id;
                    $detalle->producto_id = $Jproducto['codigo'];
                    $detalle->tip_afe_igv = $variable;
                    $inafecta = $detalle->valor_venta + $inafecta;
                    $data1 = $detalle->save();
                    break;
            }

        }
        //factura
        $factura->monto_oper_gravadas = $gravada;
        $factura->monto_oper_exonerada = $exonerada;
        $factura->monto_oper_inafectada = $inafecta;
        $factura->monto_igv = $gravada * 0.18;
        $factura->monto_total_venta = $gravada + $exonerada + $inafecta + $factura->monto_igv;
        $data = $factura->save();

        if ($data1 && $data) {
            return 'proceso_finalizado';
        } else {
            return 'ocurrio un error';
        }

    }
    public function generar_invoice($factura_id)
    {
        $util = new Util();
        $empresa = empresa::getDatosEmpresa();
        $factura = factura::find($factura_id);
        $detalles = detalle::where('factura_id', $factura_id)->get();
        // Venta
        $invoice = new Invoice();
        $invoice->setTipoDoc('01')
            ->setSerie('FF12')
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
                ->setCodProdSunat($det->producto->cod_producto)
                ->setUnidad($det->producto->unidad)
                ->setCantidad($det->cantidad)
                ->setDescripcion($det->producto->descripcion)
                ->setIgv($det->igv)
                ->setTipAfeIgv($det->tip_afe_igv) // 10-20
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
        return $invoice;

    }
    public function verGenerarFactura($factura_id)
    {
        $invoice = self::generar_invoice($factura_id);
        $util = new Util();

        try {
            $pdf = $util->getPdf($invoice);
            $util->showPdf($pdf, $invoice->getName() . '.pdf');
        } catch (Exception $e) {
            var_dump($e);
        }
    }
    public function enviarFactura($factura_id)
    {
        $invoice = self::generar_invoice($factura_id);
        $util = new Util();
        $factura = factura::find($factura_id);

        // Envio a SUNAT. demo1
        $see = $util->getSee(SunatEndpoints::FE_BETA);
        $res = $see->send($invoice);
        Util::writeXml($invoice, $see->getFactory()->getLastXml());

        try {

            if ($res->isSuccess()) {
                //@var $res \Greenter\Model\Response\BillResult
                $cdr = $res->getCdrResponse();
                Util::writeCdr($invoice, $res->getCdrZip());

                $factura->estado_factura = "Enviado";
                $factura->save();
                return $util->getResponseFromCdrJSON($cdr);

            } else {
                return var_dump($res->getError());

            }

        } catch (Exception $e) {
            return $e;

        }

    }
    public function generar_factura($factura_id)
    {
        $invoice = self::generar_invoice($factura_id);
        /*try {
        $pdf = $util->getPdf($invoice);
        $util->showPdf($pdf, $invoice->getName() . '.pdf');
        } catch (Exception $e) {
        var_dump($e);
        }*/

        /*
        // Envio a SUNAT.
        $see = $util->getSee(SunatEndpoints::FE_HOMOLOGACION);
        $res = $see->send($invoice);
        Util::writeCdr($invoice, $res->getCdrZip());

        $pdf = $util->getPdf($invoice);

        $util->showPdf($pdf, $invoice->getName() . '.pdf');

        Util::writeXml($invoice, $see->getFactory()->getLastXml());
        $factura->estado_factura = "XML Generado";
        $factura->save();
         */
        // Envio a SUNAT. demo1
        $see = $util->getSee(SunatEndpoints::FE_HOMOLOGACION);

        $res = $see->send($invoice);
        Util::writeXml($invoice, $see->getFactory()->getLastXml());

        if ($res->isSuccess()) {
            //@var $res \Greenter\Model\Response\BillResult
            $cdr = $res->getCdrResponse();
            Util::writeCdr($invoice, $res->getCdrZip());

            $factura->estado_factura = $util->getResponseFromCdr($cdr);
            $factura->save();

        } else {
            var_dump($res->getError());

        }

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
