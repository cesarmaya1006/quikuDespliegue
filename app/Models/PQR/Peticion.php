<?php

namespace App\Models\PQR;

use App\Models\Empleados\Empleado;
use App\Models\PQR\AsignacionEstado;
use App\Models\PQR\HistorialPeticion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peticion extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'peticiones';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function pqr()
    {
        return $this->belongsTo(PQR::class, 'pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function motivo()
    {
        return $this->belongsTo(SubMotivo::class, 'motivo_sub_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function hechos()
    {
        return $this->hasMany(Hecho::class, 'peticion_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function anexos()
    {
        return $this->hasMany(Anexo::class, 'peticion_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function aclaraciones()
    {
        return $this->hasMany(Aclaracion::class, 'peticion_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function respuesta()
    {
        return $this->hasOne(Respuesta::class, 'peticion_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'peticion_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialpeticiones()
    {
        return $this->hasMany(HistorialPeticion::class, 'peticion_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function estadopeticion()
    {
        return $this->belongsTo(AsignacionEstado::class, 'estado_id', 'id');
    }
    //----------------------------------------------------------------------------------

}

