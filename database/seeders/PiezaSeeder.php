<?php

namespace Database\Seeders;

use App\Models\Bloque;
use App\Models\Pieza;
use Illuminate\Database\Seeder;

class PiezaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloques = Bloque::query()->get();

        if ($bloques->isEmpty()) {
            return;
        }

        foreach ($bloques as $index => $bloque) {
            $pesoTeorico = 100 + ($index * 5);
            $pesoReal = $pesoTeorico + (($index % 2 === 0) ? 2.5 : -1.5);

            Pieza::query()->insert([
                [
                    'bloque_id' => $bloque->id,
                    'codigo' => "P{$bloque->id}A",
                    'peso_teorico' => $pesoTeorico,
                    'peso_real' => $pesoReal,
                    'diferencia_peso' => $pesoReal - $pesoTeorico,
                    'estado' => 'pendiente',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'bloque_id' => $bloque->id,
                    'codigo' => "P{$bloque->id}B",
                    'peso_teorico' => $pesoTeorico + 10,
                    'peso_real' => $pesoTeorico + 9,
                    'diferencia_peso' => -1,
                    'estado' => 'fabricada',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
