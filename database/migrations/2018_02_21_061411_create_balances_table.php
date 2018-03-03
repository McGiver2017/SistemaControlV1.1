<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo', ['ingreso', 'egreso']);
            $table->decimal('monto', 8, 2);
            $table->decimal('saldo_caja', 8, 2);
            $table->decimal('saldo_final', 8, 2);
            $table->enum('tipo_documento', ['Factura', 'Boleta','Otros']);
            $table->string('numero_documento');
            $table->enum('tipo_responsable', ['Conductor', 'Vehiculo','Otros']);
            $table->string('responsable');
            $table->integer('caja_id')->unsigned();
            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->string('monto_declarado');
            $table->enum('estado', ['Egreso declarado', 'Ingreso declarado','Egreso no declarado']);

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
        Schema::dropIfExists('balances');
    }
}
