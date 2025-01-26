<?php

namespace App\Models\Admin;

use App\Models\PQR\tipoPQR;
use App\Models\Tutela\Submotivotutela;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WikuJurisprudencia extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'wikujurisprudencia';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function subsala()
    {
        return $this->belongsTo(WikuSubsala::class, 'subsala_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function magistrado()
    {
        return $this->belongsTo(WikuMagistrado::class, 'magistrado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function demandante()
    {
        return $this->belongsTo(WikuDemandante::class, 'demandante_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function demandado()
    {
        return $this->belongsTo(WikuDemandado::class, 'demandado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function temaEspecifico()
    {
        return $this->belongsTo(WikuTemaEspecifico::class, 'wikutemaespecifico_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function textos()
    {
        return $this->hasMany(WikuJurisprudenciaTexto::class, 'jurisprudencia_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function criterios()
    {
        return $this->hasMany(WikuJurisCriterio::class, 'jurisprudencia_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function jurisprudencia()
    {
        return $this->hasMany(WikuJurisprudencia::class, 'jurisprudencia1_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function jurisprudencias()
    {
        return $this->hasMany(WikuJurisprudencia::class, 'jurisprudencia2_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function palabras()
    {
        return $this->belongsToMany(WikuPalabras::class, 'wikupalabrasjuris');
    }
    //----------------------------------------------------------------------------------
    public function asociaciones()
    {
        return $this->hasMany(WikuAsociacionJur::class, 'wiku_jurisprudencia_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tipopqr()
    {
        return $this->belongsToMany(tipoPQR::class, 'wikujurisasociaciones', 'tipo_p_q_r_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function asociacion_submotivotutelas()
    {
        return $this->belongsToMany(Submotivotutela::class, 'asociacionwikujurisprudenciatutelas','wikujurisprudencia_id', 'submotivotutela_id');
    }
    //----------------------------------------------------------------------------------
}
