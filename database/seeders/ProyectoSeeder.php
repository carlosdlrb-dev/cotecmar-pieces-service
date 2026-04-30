<?php

namespace Database\Seeders;

use App\Models\Proyecto;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proyecto::query()->insert([
            [
                'nombre' => 'Proyecto Atlas',
                'descripcion' => 'Fabricacion de piezas tipo A.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Proyecto Boreal',
                'descripcion' => 'Componentes de prueba tecnica.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
