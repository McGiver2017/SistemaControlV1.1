<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app');
});

Route::get('/factura', 'FacturaController@pruebaf1');

Route::get('/factura/{factura_id}', 'FacturaController@verGenerarFactura');
Route::get('/guia/{factura_id}', 'FacturaController@verGenerarGuia');


Route::get('/envfactura/{factura_id}', 'FacturaController@enviarFactura');


