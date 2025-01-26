<?php

namespace App\Models\Admin;

use App\Models\Empresas\Sede;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Municipio extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'municipio';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function pqrs()
    {
        return $this->hasMany(PQR::class, 'municipio_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function sedes()
    {
        return $this->hasMany(Sede::class, 'municipio_id', 'id');
    }
}
