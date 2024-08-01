<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedores')->insert([
            ['encargado' => 'Juan Perez', 'editorial' => 'Sudamericana', 'ci' => '12345678', 'telefono' => '123456789', 'correo' => 'juan.perez@example.com', 'direccion' => 'Calle Falsa 123, La Paz', 'estado' => 'activo', 'created_at' => now(), 'updated_at' => now()],
            // Agrega el resto de los proveedores aquí
        ]);
    }
}
