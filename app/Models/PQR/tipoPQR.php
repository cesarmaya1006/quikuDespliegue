<?php

namespace App\Models\PQR;

use App\Models\Admin\WikuArgumento;
use App\Models\Admin\WikuAsociacion;
use App\Models\Admin\WikuAsociacionArg;
use App\Models\Admin\WikuNorma;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class tipoPQR extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'tipo_pqr';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function motivos()
    {
        return $this->hasMany(Motivo::class, 'tipo_pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function pqrs()
    {
        return $this->hasMany(PQR::class, 'tipo_pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function asociacion_normas()
    {
        return $this->hasMany(WikuAsociacion::class, 'tipo_p_q_r_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function asociacionnorma()
    {
        return $this->belongsToMany(WikuNorma::class, 'wikuasociaciones');
    }
    //----------------------------------------------------------------------------------
    public function asociacion_argumentos()
    {
        return $this->hasMany(WikuAsociacionArg::class, 'tipo_p_q_r_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function asociacionargumento()
    {
        return $this->belongsToMany(WikuArgumento::class, 'wikuargasociaciones');
    }
}
