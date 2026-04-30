<?php

namespace Database\Seeders;

use App\Models\Bloque;
use App\Models\Proyecto;
use Illuminate\Database\Seeder;

class BloqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proyectos = Proyecto::query()->get();

        if ($proyectos->isEmpty()) {
            return;
        }

        foreach ($proyectos as $proyecto) {
            Bloque::query()->insert([
                [
                    'proyecto_id' => $proyecto->id,
                    'nombre' => "Bloque {$proyecto->id}-A",
                    'codigo' => "B{$proyecto->id}A",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'proyecto_id' => $proyecto->id,
                    'nombre' => "Bloque {$proyecto->id}-B",
                    'codigo' => "B{$proyecto->id}B",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
