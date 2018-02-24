<?php

namespace App\Http\Controllers;

use App;
use App\balance;
use App\caja;
use App\conductor;
use App\detalle_factura as detalle;
use App\empresa;
use App\factura;
use App\guia;
use App\producto;
use App\proveedor;
use App\transporte;
use App\Util;
use App\vehiculo;
use DateTime;

//despath
use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Despatch\Despatch;
use Greenter\Model\Despatch\DespatchDetail;
use Greenter\Model\Despatch\Direction;
use Greenter\Model\Despatch\Shipment;
use Greenter\Model\Despatch\Transportist;
use Greenter\Model\Sale\Document;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Ws\Services\SunatEndpoints;

//balance

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
    public function guardar_guia(Request $request)
    {
        $tranporte = new transporte;
        $date = new DateTime($request->transporte['fechaEnvio']);

        $tranporte->conductor_id = $request->conductor;
        $tranporte->vehiculo_id = $request->vehiculo;
        $tranporte->proveedor_id = $request->proveedor;
        $tranporte->estado = "En servicio";
        $tranporte->ingresos = $request->transporte['ingreso'];
        $tranporte->egresos = 0;
        $tranporte->fecha_envio = $date->format('Y-m-d H:i:s');
        $tranporte->modalidad_transporte = $request->ModalidadTraslado;
        $tranporte->p_partida = $request->transporte['partida'];
        $tranporte->p_llegada = $request->transporte['llegada'];
        $tranporte->motivo_traslado = "Venta";
        $tranporte->save();
        $empresa = empresa::getDatosEmpresa();
        $Origenemp = $empresa['origenguia'];
        $cguia = guia::get();
        $guia = new guia;
        $guia->transporte_id = $tranporte->id;
        $guia->correlativo = $Origenemp + count($cguia);
        $guia->save();

        //cambio de estado de conductor y vehiculo
        $conductor = conductor::find($request->conductor);
        $conductor->estado = "en servicio";
        $conductor->save();
        $vehiculo = vehiculo::find($request->vehiculo);
        $vehiculo->estado = "en servicio";
        $vehiculo->save();
        //caja
        //buscar la caja
        $caja = caja::where('estado', 'Abierto')->first();
        //
        $balancenew = new balance;
        $balancenew->tipo = 'egreso';
        $balancenew->caja_id = $caja->id;
        $balancenew->monto = $tranporte->ingresos;
        $balancenew->saldo_caja = $caja->monto;
        $balancenew->saldo_final = $caja->monto - $tranporte->ingresos;
        $balancenew->vehiculo = $request->vehiculo;
        $balancenew->save();
        $caja->monto = $balancenew->saldo_final;
        $caja->save();
        return $guia->id;

    }
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
        $factura->guia_id = self::guardar_guia($request);
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
        //caja
        //buscar la caja
        $caja = caja::where('estado', 'Abierto')->first();
        //
        $balancenew = new balance;
        $balancenew->tipo = 'ingreso';
        $balancenew->caja_id = $caja->id;
        $balancenew->monto = $factura->monto_total_venta;
        $balancenew->saldo_caja = $caja->monto;
        $balancenew->saldo_final = $caja->monto + $factura->monto_total_venta;
        $balancenew->vehiculo = $request->vehiculo;
        $balancenew->save();
        $caja->monto = $balancenew->saldo_final;
        $caja->save();
        if ($data1 && $data) {
            return 'proceso_finalizado';
        } else {
            return 'ocurrio un error';
        }

    }
    private function getItems($detail, $count)
    {
        $items = [];
        for ($i = 0; $i < $count; ++$i) {
            $items[] = $detail;
        }

        return $items;
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
    public function getClient()
    {
        $client = new Client();
        $client->setTipoDoc('6')
            ->setNumDoc('20000000001')
            ->setRznSocial('EMPRESA 1')
            ->setAddress((new Address())
                    ->setDireccion('JR. NIQUEL MZA. F LOTE. 3 URB.  INDUSTRIAL INFANTAS - LIMA - LIMA -PERU'));

        return $client;
    }
    public function Generar_Despatch($factura_id)
    {

        $factura = factura::find($factura_id);
        $guia = guia::find($factura->guia_id);
        $detalles = detalle::where('factura_id', $factura_id)->get();
        $transporte = transporte::find($guia->transporte_id);
        $conductor = conductor::find($transporte->conductor_id);
        $vehiculo = vehiculo::find($transporte->vehiculo_id);
        //return str_pad($guia->correlativo, 5, "0", STR_PAD_LEFT);
        $baja = new Document();
        $baja->setTipoDoc('09')
            ->setNroDoc('T001-' . str_pad($guia->correlativo, 5, "0", STR_PAD_LEFT));

        $rel = new Document();
        $rel->setTipoDoc('02') // Tipo: Numero de Orden de Entrega
            ->setNroDoc('213123');

        $transp = new Transportist();
        $transp->setTipoDoc('6')
            ->setNumDoc(Util::getruc())
            ->setRznSocial(Util::getrzsoc())
            ->setPlaca($vehiculo->placa)
            ->setChoferTipoDoc('1')
            ->setChoferDoc($conductor->dni);

        $envio = new Shipment();
        $envio->setModTraslado($transporte->modalidad_transporte)
            ->setCodTraslado($transporte->modalidad_transporte)
            ->setDesTraslado($transporte->motivo_traslado)
            ->setFecTraslado(new \DateTime())
            ->setCodPuerto('123')
            ->setIndTransbordo(false)
            ->setPesoTotal(12.5)
            ->setUndPesoTotal('KGM')
            ->setNumBultos(0)
            ->setNumContenedor('XD-2232')
            ->setLlegada(new Direction('150101', $transporte->p_partida))
            ->setPartida(new Direction('150203', $transporte->p_llegada))
            ->setTransportista($transp);

        $despatch = new Despatch();
        $despatch->setTipoDoc('09')
            ->setSerie('T001')
            ->setCorrelativo(str_pad($guia->correlativo, 5, "0", STR_PAD_LEFT))
            ->setFechaEmision($guia->created_at)
            ->setCompany(Util::getCompany())
            ->setDestinatario(Util::getClient($factura->cliente_id))
            ->setTercero((new Client())
                    ->setTipoDoc('6')
                    ->setNumDoc('20000000003')
                    ->setRznSocial('GREENTER SA'))
            ->setObservacion('NOTA GUIA')
            ->setDocBaja($baja)
            ->setRelDoc($rel)
            ->setEnvio($envio);

        $items = [];
        foreach ($detalles as $det) {
            $item = new DespatchDetail();
            $item->setCantidad($det->cantidad)
                ->setUnidad('ZZ')
                ->setDescripcion($det->producto->descripcion)
                ->setCodigo($det->producto->cod_producto)
                ->setCodProdSunat($det->producto->cod_producto);
            $items[] = $item;
        }
        $despatch->setDetails($items);

        return $despatch;
    }
    public function verGenerarGuia($factura_id)
    {
        $util = new Util();

        $despatch = self::Generar_Despatch($factura_id);
        try {
            $pdf = $util->getPdf($despatch);
            $util->showPdf($pdf, $despatch->getName() . '.pdf');
        } catch (Exception $e) {
            var_dump($e);
        }

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
