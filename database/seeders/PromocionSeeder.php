<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromocionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promociones')->insert([
            ['id_producto' => 1, 'nombre' => 'Descuento de Verano', 'descripcion' => 'Promoción de verano para Cien Años de Soledad', 'descuento' => 10.00, 'fecha_inicio' => '2023-07-01', 'fecha_fin' => '2023-07-31', 'created_at' => now(), 'updated_at' => now()],
            // Agrega el resto de las promociones aquí
        ]);
    }
}
