<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guia_id')->unsigned();
            $table->foreign('guia_id')->references('id')->on('guias');
            $table->string('tipo_doc')->default('01');
            $table->string('serie')->default('FF11');
            $table->string('correlativo')->nullable();
            $table->date('fecha_emision');
            $table->string('fecha_vencimiento')->nullable();
            $table->string('tipo_moneda')->default('PEN');
            $table->decimal('monto_oper_gravadas', 8, 2);
            $table->integer('monto_oper_exonerada')->default(0);
            $table->integer('monto_oper_inafectada')->default(0);
            $table->decimal('monto_igv', 8, 2);
            $table->decimal('monto_total_venta', 8, 2);
            $table->integer('legen_cod')->nullable();
            $table->string('legen_descripcion')->nullable();
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('crs_id')->nullable();
            $table->string('crs_estado')->nullable();
            $table->string('nombre_pdf')->nullable();
            $table->string('estado_factura')->default('No enviado');
            $table->enum('estado_pago', ['Pendiente', 'Pagado'])->default('Pendiente');
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
        Schema::dropIfExists('facturas');
    }
}
