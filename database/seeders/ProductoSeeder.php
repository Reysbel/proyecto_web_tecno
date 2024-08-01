<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            ['nombre' => 'Cien Años de Soledad', 'autor' => 'Gabriel García Márquez', 'editorial' => 'Sudamericana', 'breve_descripcion' => 'Una novela épica', 'descripcion' => 'Descripción detallada de la novela', 'precio_compra' => 50.00, 'precio' => 80.00, 'imagen' => 'imagenes/cien_anos.jpg', 'descuento' => 0, 'total_venta' => 80.00, 'stock' => 50, 'estado' => 'activo', 'id_categoria' => 1, 'created_at' => now(), 'updated_at' => now()],
            // Agrega el resto de los productos aquí
        ]);
    }
}
