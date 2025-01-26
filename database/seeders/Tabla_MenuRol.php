<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_MenuRol extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 12; $i++) {
            DB::table('menu_rol')->insert([
                'rol_id' => '1',
                'menu_id' => $i,
            ]);
        }

        for ($i = 2; $i <= 6; $i++) {
            DB::table('menu_rol')->insert([
                'rol_id' => $i,
                'menu_id' => '1',
            ]);
        }
        for ($i = 9; $i <= 16; $i++) {
            DB::table('menu_rol')->insert([
                'rol_id' => '6',
                'menu_id' => $i,
            ]);
        }
        for ($i = 18; $i <= 21; $i++) {
            DB::table('menu_rol')->insert([
                'rol_id' => '5',
                'menu_id' => $i,
            ]);
        }
        for ($i = 27; $i <= 35; $i++) {
            DB::table('menu_rol')->insert([
                'rol_id' => '5',
                'menu_id' => $i,
            ]);
        }
        for ($i = 22; $i <= 26; $i++) {
            DB::table('menu_rol')->insert([
                'rol_id' => '3',
                'menu_id' => $i,
            ]);
        }
        DB::table('menu_rol')->insert([
            'rol_id' => '3',
            'menu_id' => '36',
        ]);
    }
}
