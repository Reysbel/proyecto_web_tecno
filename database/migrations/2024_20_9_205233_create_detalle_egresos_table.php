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
        Schema::create('detalle_egresos', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_egreso', 10, 2)->nullable();
            $table->date('fecha');
            $table->unsignedBigInteger('id_compra');
            $table->unsignedBigInteger('id_reporte');
            $table->timestamps();

            $table->foreign('id_compra')->references('id_compra')->on('compras')->onDelete('cascade');
            $table->foreign('id_reporte')->references('id_reporte')->on('reportes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_egresos');
    }
};
