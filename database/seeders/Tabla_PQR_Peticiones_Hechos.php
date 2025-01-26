<?php

namespace Database\Seeders;

use App\Models\PQR\AsignacionTarea;
use App\Models\PQR\Motivo;
use App\Models\PQR\Peticion;
use App\Models\PQR\SubMotivo;
use App\Models\PQR\Tarea;
use App\Models\PQR\tipoPQR;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_PQR_Peticiones_Hechos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha_ini = date('2023-01-01');
        for ($i = 1; $i < 141; $i++) {
            $fecha_generacion = date('Y-m-d',strtotime(date('Y-m-d', strtotime($fecha_ini . '+ ' . $i . ' days')) .' + ' .rand(1, 6) . ' days' ));
            $fecha_radicado = date('Y-m-d', strtotime($fecha_generacion . '+ ' . 1 . ' days'));
            $estado_asignacion = rand(0, 1);
            $fecha_respuesta = date('Y-m-d', strtotime($fecha_radicado . '- ' . rand(0, 5) . ' days'));
            $tiempo_limite = rand(15, 20);
            $fecha_respuesta = date('Y-m-d', strtotime($fecha_respuesta . '+ ' . $tiempo_limite . ' days'));
            if ($estado_asignacion) {
                $estadospqr_id = 2;
            } else {
                $estadospqr_id = 1;
            }

            $tipo_pqr_id = rand(1, 3);

            DB::table('pqr')->insert([
                'id' => $i,
                'radicado' => 'PQR-2023-' . $i,
                'empleado_id' =>  6,
                'persona_id' => '4',
                'tipo_pqr_id' => $tipo_pqr_id,
                'adquisicion' => 'Sede física',
                'sede_id' => '2',
                'tipo' => 'Producto',
                'referencia_id' => rand(1, 40),
                'prioridad_id' => '2',
                'factura' => 987654355 + $i,
                'fecha_factura' => date('Y-m-d',strtotime($fecha_ini . '+ ' . $i . ' days')),
                'prorroga' => '0',
                'prorroga_dias' => '0',
                'prorroga_pdf' => 'NULL',
                'fecha_generacion' => $fecha_generacion,
                'fecha_radicado' => $fecha_radicado,
                'fecha_respuesta' => $fecha_respuesta,
                'tiempo_limite' => $tiempo_limite,
                'estado_asignacion' => $estado_asignacion,
                'estadospqr_id' => $estadospqr_id,
                'estado_creacion' => '1',
                'recurso_aclaracion' => '0',
                'recurso_reposicion' => '0',
                'recurso_apelacion' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $tipoPQR = tipoPQR::findOrFail($tipo_pqr_id);
            $motivo = Motivo::findOrfail($tipoPQR->motivos->random()->id);
            for ($j = 1; $j < rand(2, 4); $j++) {
                $newPeticion['pqr_id'] = $i;
                $newPeticion['motivo_sub_id'] = $motivo->sub_motivos->random()->id;
                $newPeticion['estado_id'] = '1';
                $newPeticion['recurso'] = '0';
                $newPeticion['usuario_recurso'] = '0';
                $newPeticion['justificacion'] ='Solictud ' . $i . ' hecho 1 peticion ' . $j;
                $newPeticion['aclaracion'] = '0';
                $newPeticion['apelacion'] = '0';
                $peticion = Peticion::create($newPeticion);
                for ($k = 1; $k < rand(2, 4); $k++) {
                    DB::table('hechos')->insert([
                        'peticion_id' => $peticion->id,
                        'hecho' =>'Hecho de prueba ' . $k . ' creado por el sistema',
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                }
            }

            $tareas = Tarea::all();
            $validarTareas = AsignacionTarea::where('pqr_id', $i)->get();
            if (!sizeOf($validarTareas)) {
                foreach ($tareas as $value) {
                    $asignacionTarea['pqr_id'] = $i;
                    $asignacionTarea['empleado_id'] = 6;
                    $asignacionTarea['tareas_id'] = $value['id'];
                    $asignacionTarea['estado_id'] = 1;
                    AsignacionTarea::create($asignacionTarea);
                }
            }
        }
    }
}
