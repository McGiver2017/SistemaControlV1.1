<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('user', 'UserController');
Route::resource('cliente', 'ClienteController');
Route::resource('proveedor', 'ProveedorController');
Route::resource('conductor', 'ConductorController');
Route::resource('vehiculo', 'VehiculoController');
Route::resource('producto', 'ProductoController');
Route::resource('factura', 'FacturaController');
Route::resource('transporte', 'TransporteController');
Route::resource('detalletransporte', 'DetalletransporteController');
Route::resource('caja', 'CajaController');
Route::resource('detallecaja', 'BalanceController');



//---rutas get producto
Route::get('/getproducto', 'ProductoController@getproductolist');
Route::get('/getcliente', 'ClienteController@getclientelist');
Route::get('/getproveedor', 'ProveedorController@getproveedorlist');
Route::get('/getconductor', 'ConductorController@getconductorlist');
Route::get('/getvehiculo', 'VehiculoController@getvehiculolist');

//en factura
Route::get('/envfactura/{factura_id}', 'FacturaController@enviarFactura');
Route::get('/pagarfactura/{id_factura}', 'FacturaController@cambio_estado_factura_pagado');


Route::post('/usuarios', 'UserController@login');

//---rutas peticion sunat---
Route::get('/getdni/{dni}','SolicitudSunatController@obtener_datos_con_dni');
Route::get('/getruc/{ruc}','SolicitudSunatController@obtener_datos_con_ruc');







