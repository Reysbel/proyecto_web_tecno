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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre');
            $table->string('autor');
            $table->string('editorial');
            $table->string('breve_descripcion')->nullable();
            $table->text('descripcion')->nullable();
            $table->decimal('precio_compra', 8, 2);
            $table->decimal('precio', 8, 2);
            $table->text('imagen')->nullable();
            $table->decimal('descuento', 10, 2)->nullable();
            $table->decimal('total_venta', 10, 2);
            $table->integer('stock'); // Cambiado a integer
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->unsignedBigInteger('id_categoria');
            $table->timestamps();

            // Definimos las claves foráneas
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('cascade'); // Agregado onDelete('cascade')
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
