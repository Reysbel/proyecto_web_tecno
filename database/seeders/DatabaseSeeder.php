<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run()
{
    $this->call([
        CategoriaSeeder::class,
        ProductoSeeder::class,
        ProveedorSeeder::class,
        CompraSeeder::class,
        DetalleCompraSeeder::class,
        PromocionSeeder::class,
    ]);
}
}