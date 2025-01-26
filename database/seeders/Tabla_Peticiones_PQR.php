<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Peticiones_PQR extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peticiones = [
            ['id'=>1,'pqr_id'=>1,'motivo_sub_id'=>3,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 1'],
            ['id'=>2,'pqr_id'=>1,'motivo_sub_id'=>1,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 1'],
            ['id'=>3,'pqr_id'=>2,'motivo_sub_id'=>2,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 2'],
            ['id'=>4,'pqr_id'=>2,'motivo_sub_id'=>1,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 2'],
            ['id'=>5,'pqr_id'=>2,'motivo_sub_id'=>2,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 2'],
            ['id'=>6,'pqr_id'=>3,'motivo_sub_id'=>22,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 3'],
            ['id'=>7,'pqr_id'=>3,'motivo_sub_id'=>17,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 3'],
            ['id'=>8,'pqr_id'=>4,'motivo_sub_id'=>17,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 4'],
            ['id'=>9,'pqr_id'=>5,'motivo_sub_id'=>19,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 5'],
            ['id'=>10,'pqr_id'=>5,'motivo_sub_id'=>23,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 5'],
            ['id'=>11,'pqr_id'=>6,'motivo_sub_id'=>20,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 6'],
            ['id'=>12,'pqr_id'=>6,'motivo_sub_id'=>13,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 6'],
            ['id'=>13,'pqr_id'=>6,'motivo_sub_id'=>25,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 6'],
            ['id'=>14,'pqr_id'=>4,'motivo_sub_id'=>17,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 4'],
            ['id'=>15,'pqr_id'=>7,'motivo_sub_id'=>18,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 7'],
            ['id'=>16,'pqr_id'=>7,'motivo_sub_id'=>19,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 7'],
            ['id'=>17,'pqr_id'=>8,'motivo_sub_id'=>23,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 8'],
            ['id'=>18,'pqr_id'=>9,'motivo_sub_id'=>16,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 9'],
            ['id'=>19,'pqr_id'=>9,'motivo_sub_id'=>18,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 9'],
            ['id'=>20,'pqr_id'=>10,'motivo_sub_id'=>14,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 10'],
            ['id'=>21,'pqr_id'=>10,'motivo_sub_id'=>17,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 10'],
            ['id'=>22,'pqr_id'=>11,'motivo_sub_id'=>13,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 11'],
            ['id'=>23,'pqr_id'=>11,'motivo_sub_id'=>19,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 11'],
            ['id'=>24,'pqr_id'=>11,'motivo_sub_id'=>22,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 11'],
            ['id'=>25,'pqr_id'=>12,'motivo_sub_id'=>18,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 12'],
            ['id'=>26,'pqr_id'=>13,'motivo_sub_id'=>19,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 13'],
            ['id'=>27,'pqr_id'=>14,'motivo_sub_id'=>3,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 14'],
            ['id'=>28,'pqr_id'=>15,'motivo_sub_id'=>1,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 15'],
            ['id'=>29,'pqr_id'=>15,'motivo_sub_id'=>3,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 15'],
            ['id'=>30,'pqr_id'=>16,'motivo_sub_id'=>20,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 16'],
            ['id'=>31,'pqr_id'=>16,'motivo_sub_id'=>18,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 16'],
            ['id'=>32,'pqr_id'=>17,'motivo_sub_id'=>3,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 17'],
            ['id'=>33,'pqr_id'=>17,'motivo_sub_id'=>3,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 17'],
            ['id'=>34,'pqr_id'=>18,'motivo_sub_id'=>13,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 18'],
            ['id'=>35,'pqr_id'=>19,'motivo_sub_id'=>3,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 19'],
            ['id'=>36,'pqr_id'=>19,'motivo_sub_id'=>2,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 19'],
            ['id'=>37,'pqr_id'=>20,'motivo_sub_id'=>13,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 20'],
            ['id'=>38,'pqr_id'=>20,'motivo_sub_id'=>18,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 20'],
            ['id'=>39,'pqr_id'=>20,'motivo_sub_id'=>21,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 20'],
            ['id'=>40,'pqr_id'=>21,'motivo_sub_id'=>21,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 21'],
            ['id'=>41,'pqr_id'=>21,'motivo_sub_id'=>23,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 21'],
            ['id'=>42,'pqr_id'=>22,'motivo_sub_id'=>1,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 22'],
            ['id'=>43,'pqr_id'=>23,'motivo_sub_id'=>20,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 23'],
            ['id'=>44,'pqr_id'=>23,'motivo_sub_id'=>25,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 23'],
            ['id'=>45,'pqr_id'=>24,'motivo_sub_id'=>2,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 24'],
            ['id'=>46,'pqr_id'=>24,'motivo_sub_id'=>3,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 24'],
            ['id'=>47,'pqr_id'=>25,'motivo_sub_id'=>3,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 25'],
            ['id'=>48,'pqr_id'=>25,'motivo_sub_id'=>3,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 25'],
            ['id'=>49,'pqr_id'=>26,'motivo_sub_id'=>1,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 26'],
            ['id'=>50,'pqr_id'=>26,'motivo_sub_id'=>1,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 26'],
            ['id'=>51,'pqr_id'=>27,'motivo_sub_id'=>23,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 27'],
            ['id'=>52,'pqr_id'=>27,'motivo_sub_id'=>19,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 27'],
            ['id'=>53,'pqr_id'=>28,'motivo_sub_id'=>24,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 28'],
            ['id'=>54,'pqr_id'=>28,'motivo_sub_id'=>25,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 28'],
            ['id'=>55,'pqr_id'=>29,'motivo_sub_id'=>13,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 29'],
            ['id'=>56,'pqr_id'=>29,'motivo_sub_id'=>22,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 29'],
            ['id'=>57,'pqr_id'=>30,'motivo_sub_id'=>1,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 30'],
            ['id'=>58,'pqr_id'=>30,'motivo_sub_id'=>2,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 30'],
            ['id'=>59,'pqr_id'=>31,'motivo_sub_id'=>14,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 31'],
            ['id'=>60,'pqr_id'=>31,'motivo_sub_id'=>24,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 31'],
            ['id'=>61,'pqr_id'=>32,'motivo_sub_id'=>1,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 32'],
            ['id'=>62,'pqr_id'=>33,'motivo_sub_id'=>1,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 33'],
            ['id'=>63,'pqr_id'=>33,'motivo_sub_id'=>3,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 33'],
            ['id'=>64,'pqr_id'=>34,'motivo_sub_id'=>3,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 34'],
            ['id'=>65,'pqr_id'=>34,'motivo_sub_id'=>1,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 34'],
            ['id'=>66,'pqr_id'=>35,'motivo_sub_id'=>15,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 35'],
            ['id'=>67,'pqr_id'=>35,'motivo_sub_id'=>23,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 35'],
            ['id'=>68,'pqr_id'=>35,'motivo_sub_id'=>20,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 35'],
            ['id'=>69,'pqr_id'=>35,'motivo_sub_id'=>14,'estado_id'=>1,'recurso'=>0,'usuario_recurso'=>0,'recurso_dias'=>0,'justificacion'=>'pqr de prueba - 35'],



        ];
        foreach ($peticiones as $key => $value) {
            DB::table('peticiones')->insert([
                'id' => $value['id'],
                'pqr_id' => $value['pqr_id'],
                'motivo_sub_id' => $value['motivo_sub_id'],
                'estado_id' => $value['estado_id'],
                'recurso' => $value['recurso'],
                'usuario_recurso' => $value['usuario_recurso'],
                'recurso_dias' => $value['recurso_dias'],
                'justificacion' => $value['justificacion'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
