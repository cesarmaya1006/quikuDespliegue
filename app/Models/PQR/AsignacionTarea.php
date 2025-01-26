<?php

namespace App\Models\PQR;

use App\Models\PQR\PQR;
use App\Models\PQR\Tarea;
use App\Models\Empleados\Empleado;
use App\Models\PQR\AsignacionEstado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AsignacionTarea extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'asignancion_tareas';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tareas_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function pqr()
    {
        return $this->belongsTo(PQR::class, 'pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function estadotarea()
    {
        return $this->belongsTo(AsignacionEstado::class, 'estado_id', 'id');
    }
    //----------------------------------------------------------------------------------

}
