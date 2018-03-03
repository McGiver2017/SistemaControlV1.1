<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportes', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('ingresos', 8, 2);
            $table->decimal('egresos', 8, 2);
            $table->date('fecha_envio');
            $table->string('estado');
            $table->string('modalidad_transporte');
            $table->string('p_partida');
            $table->string('p_llegada');
            $table->string('motivo_traslado')->default('venta');
            $table->integer('conductor_id')->unsigned();
            $table->foreign('conductor_id')->references('id')->on('conductors');
            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->string('balance_id');
            $table->decimal('exceso', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transportes');
    }
}
