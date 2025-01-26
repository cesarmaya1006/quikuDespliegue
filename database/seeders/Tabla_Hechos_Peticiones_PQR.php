<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Hechos_Peticiones_PQR extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 70; $i++) {
            for ($j=1; $j < 3; $j++) {
                DB::table('hechos')->insert([
                    'peticion_id' => $i,
                    'hecho' => 'Hecho de prueba peticion '. $i . ' - ' . $j,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
