<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $servicios = [
            'CFE',
            'JAPAY',
            'Telmex',
            'Izzi',
            'Megacable',
            'Totalplay',
            'Dish',
            'Axtel',
            'Gas Natural',
            'Sky',
            'Movistar',
            'AT&T',
            'Red Compartida',
            'Claro Video',
            'Blim TV',
        ];

        foreach ($servicios as $servicio) {
            DB::table('servicios')->insert([
                'nombre' => $servicio,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
