<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetalleCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalle_compras')->insert([
            ['cantidad' => 5, 'total' => 250.00, 'id_producto' => 1, 'id_compra' => 1, 'created_at' => now(), 'updated_at' => now()],
            // Agrega el resto de los detalles de compra aquí
        ]);
    }
}
