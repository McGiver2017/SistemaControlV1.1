<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalletransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalletransportes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transporte_id')->unsigned();
            $table->foreign('transporte_id')->references('id')->on('transportes');
            $table->string('num_doc');
            $table->string('descripcion');
            $table->string('monto');
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
        Schema::dropIfExists('detalletransportes');
    }
}
