<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->id('id_promocion'); 
            $table->unsignedBigInteger('id_producto'); 
            $table->string('nombre');
            $table->text('descripcion')->nullable(); 
            $table->decimal('descuento', 5, 2); 
            $table->date('fecha_inicio'); 
            $table->date('fecha_fin'); 
            $table->timestamps(); 
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promociones');
    }
};
