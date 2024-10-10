<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;



class AmenidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenidades = [
            'Gimnasio',
            'Piscina',
            'Área de juegos infantiles',
            'Salón de eventos',
            'Terraza',
            'Estacionamiento techado',
            'Seguridad 24 horas',
            'Circuito cerrado de cámaras',
            'Elevador',
            'Jardines',
            'Asadores',
            'Áreas verdes',
            'Sala de cine',
            'Wi-Fi en áreas comunes',
            'Centro de negocios',
        ];

        foreach ($amenidades as $amenidad) {
            DB::table('amenidades')->insert([
                'nombre' => $amenidad,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
