<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Libros', 'imagen' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Revistas', 'imagen' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ciencia Ficción', 'imagen' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Historia', 'imagen' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Novelas', 'imagen' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Infantiles', 'imagen' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tecnología', 'imagen' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Salud', 'imagen' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Deportes', 'imagen' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Culinaria', 'imagen' => NULL, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
