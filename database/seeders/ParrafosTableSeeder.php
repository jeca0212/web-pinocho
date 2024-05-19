<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parrafo;

class ParrafosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Acompañamientos
        Parrafo::create([
            'contenido' => 'Acompañamiento 1',
        ]);

        Parrafo::create([
            'contenido' => 'Acompañamiento 2',
        ]);

        Parrafo::create([
            'contenido' => 'Acompañamiento 3',
        ]);

        // Principales
        Parrafo::create([
            'contenido' => 'Principal 1',
        ]);

        Parrafo::create([
            'contenido' => 'Principal 2',
        ]);

        Parrafo::create([
            'contenido' => 'Principal 3',
        ]);
    }
}