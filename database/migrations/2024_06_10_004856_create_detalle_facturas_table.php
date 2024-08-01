<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_facturas', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_factura');
            $table->timestamps();

            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->foreign('id_factura')->references('id_factura')->on('facturas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_facturas');
    }
};
