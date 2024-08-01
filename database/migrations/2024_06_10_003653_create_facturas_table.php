<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('id_factura');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreignId('id_cliente')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null')
                ->where('role', 'cliente');
            $table->unsignedBigInteger('id_lcliente')->nullable();
            $table->string('nit')->nullable();
            $table->date('fecha');
            $table->time('hora');
            $table->decimal('sub_total', 10, 2);
            $table->decimal('descuento', 10, 2)->nullable();
            $table->decimal('total_factura', 10, 2);
            $table->enum('tipo_cliente', ['local', 'web']);
            $table->enum('metodo_pago', ['pagofacil', 'tigomoney','efectivo'])->default('efectivo');
            $table->enum('estado_factura', ['pendiente', 'pagada', 'anulada'])->default('pendiente');
            $table->enum('pedido_estado', ['procesando', 'enviado', 'entregado'])->default('procesando');
            $table->boolean('listo')->default(false);
            $table->timestamps();
            $table->foreign('id_lcliente')->references('id_lcliente')->on('lclientes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
