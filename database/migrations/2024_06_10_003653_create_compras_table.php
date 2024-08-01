<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id('id_compra');
            $table->string('nit_recibo')->nullable();
            $table->date('fecha');
            $table->decimal('total_compra', 10, 2);
            $table->unsignedBigInteger('id_proveedor')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
