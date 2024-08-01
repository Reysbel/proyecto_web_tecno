<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compras')->insert([
            ['nit_recibo' => '123456789', 'fecha' => '2023-07-01', 'total_compra' => 400.00, 'id_proveedor' => 1, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            // Agrega el resto de las compras aquí
        ]);
    }
}
