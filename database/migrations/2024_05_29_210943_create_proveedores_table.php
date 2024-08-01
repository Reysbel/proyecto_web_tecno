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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id('id_proveedor');
            $table->string('encargado');
            $table->string('editorial');
            $table->string('ci')->nullable();
            $table->string('telefono');
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
};

