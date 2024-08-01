<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPedidoEstadoToPedidoWebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedido_web', function (Blueprint $table) {
            $table->enum('pedido_estado', ['procesando', 'pedido aceptado', 'enviado', 'entregado', 'no entregado'])
                  ->default('procesando')
                  ->after('nota'); // Coloca esto después de la columna 'nota' o ajusta según tu esquema
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido_web', function (Blueprint $table) {
            $table->dropColumn('pedido_estado');
        });
    }
}

