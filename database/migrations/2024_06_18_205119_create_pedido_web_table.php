<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoWebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_web', function (Blueprint $table) {
            $table->id('id_pedido');
            $table->string('ubicacion')->nullable();
            $table->string('referencia_ubicacion')->nullable();
            $table->string('telefono_referencia')->nullable();
            $table->time('tiempo_demora')->nullable();
            $table->text('nota')->nullable();
            $table->enum('pedido', ['domicilio', 'local']);
            $table->unsignedBigInteger('id_factura')->nullable();
            $table->unsignedBigInteger('id_delivery')->nullable();
            $table->timestamps();
            $table->foreign('id_delivery')->references('id_delivery')->on('deliverys')->onDelete('cascade');
            $table->foreign('id_factura')->references('id_factura')->on('facturas')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_web');
    }
}

