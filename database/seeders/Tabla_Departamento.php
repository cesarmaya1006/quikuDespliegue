<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Departamento extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            ['departamento' => 'Antioquia'],
            ['departamento' => 'Atlántico'],
            ['departamento' => 'Bogotá D.C.'],
            ['departamento' => 'Bolívar'],
            ['departamento' => 'Boyacá'],
            ['departamento' => 'Caldas'],
            ['departamento' => 'Caquetá'],
            ['departamento' => 'Cauca'],
            ['departamento' => 'Cesar'],
            ['departamento' => 'Córdoba'],
            ['departamento' => 'Cundinamarca'],
            ['departamento' => 'Chocó'],
            ['departamento' => 'Huila'],
            ['departamento' => 'La Guajira'],
            ['departamento' => 'Magdalena'],
            ['departamento' => 'Meta'],
            ['departamento' => 'Nariño'],
            ['departamento' => 'Norte de Santander'],
            ['departamento' => 'Quindío'],
            ['departamento' => 'Risaralda'],
            ['departamento' => 'Santander'],
            ['departamento' => 'Sucre'],
            ['departamento' => 'Tolima'],
            ['departamento' => 'Valle del Cauca'],
            ['departamento' => 'Arauca'],
            ['departamento' => 'Casanare'],
            ['departamento' => 'Putumayo'],
            ['departamento' => 'San Andrés'],
            ['departamento' => 'Amazonas'],
            ['departamento' => 'Guainía'],
            ['departamento' => 'Guaviare'],
            ['departamento' => 'Vaupés'],
            ['departamento' => 'Vichada'],

        ];
        foreach ($areas as $item) {
            DB::table('departamento')->insert([
                'departamento' => $item['departamento'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
