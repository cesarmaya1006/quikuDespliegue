<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\Tabla_TipoAccion;
use Database\Seeders\Tabla_UnidadNegocio;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTablas([
            'docutipos', 'roles', 'menu', 'menu_rol', 'icono', 'pais', 'departamento', 'municipio',
            'sedes', 'parametros', 'areas', 'niveles', 'cargos', 'tipo_reposicion', 'area_influencia',
            'usuarios', 'personas', 'tipo_pqr', 'prioridades', 'estadospqr', 'motivos', 'motivo_sub', 'categorias', 'productos', 'marcas',
            'referencias', 'servicios', 'diasfestivos', 'asignacion_particular_pqr', 'despachos',
            'wikuareas', 'wikutemas', 'wikutemaespecifico','wikupalabrasargumentos',
            'wikudocument','wikuautores','wikupalabrasclave','wikuargumentos',
            'estadostutela', 'tareas_tutela', 'asignacion_estados_tutela',
            'auto_admisorio', 'tutela_motivo', 'accionante_accionado', 'hechos_tutela', 'pretensiones_tutela',
            'argumentos_tutela', 'historial_primera_asignacion_tutela', 'asignancion_tareas_tutela', 'sentenciapinstancia',
            'resuelvesentencia', 'tipo_accion', 'tipo_persona', 'unidad_negocio','motivotutelas','submotivotutelas','pqr','peticiones',
            'hechos'

        ]);
        // --------------------------------------------------------------------------------------------------
        $this->call(Tabla_DocuTipos::class);
        $this->call(Tabla_Roles::class);
        $this->call(Tabla_Menu::class);
        $this->call(Tabla_MenuRol::class);
        $this->call(Tabla_Icono::class);
        $this->call(Tabla_Pais::class);
        $this->call(Tabla_Departamento::class);
        $this->call(Tabla_Municipio::class);
        $this->call(Tabla_Sedes::class);
        $this->call(Tabla_Parametros::class);
        $this->call(Tabla_Areas::class);
        $this->call(Tabla_Niveles::class);
        $this->call(Tabla_Cargos::class);
        $this->call(Tabla_TiposReposicion::class);
        $this->call(Tabla_AreasInfluencia::class);
        $this->call(Tabla_Usuarios::class);
        $this->call(Tabla_TipoPQR::class);
        $this->call(Tabla_prioridades::class);
        $this->call(Tabla_EstadosPQR::class);
        $this->call(Tabla_Motivos::class);
        $this->call(Tabla_SubMotivos::class);
        $this->call(Tabla_Categorias::class);
        $this->call(Tabla_Productos::class);
        $this->call(Tabla_Marcas::class);
        $this->call(Tabla_Referencias::class);
        $this->call(Tabla_Servicios::class);
        $this->call(Tabla_DiasFestivos::class);
        $this->call(Tabla_Tareas::class);
        $this->call(Tabla_AsignancionEstados::class);
        $this->call(Tabla_AsignacionParticularPQR::class);
        $this->call(Tabla_WikuAreas::class);
        $this->call(Tabla_WikuTemas::class);
        $this->call(Tabla_WikuTemasEspecificos::class);
        $this->call(Tabla_WikuFuente::class);
        $this->call(Tabla_numeracion::class);
        $this->call(Tabla_despachos::class);
        $this->call(Tabla_EstadosTutela::class);
        $this->call(Tabla_TareasTutela::class);
        $this->call(Tabla_AsignacionEstadosTutela::class);
        $this->call(Tabla_TipoPersona::class);
        $this->call(Tabla_TipoAccion::class);
        $this->call(Tabla_UnidadNegocio::class);
        //$this->call(TutelaAutoAdmisorio::class);
        //$this->call(TutelaMotivo::class);
        //$this->call(TutelaAccionanteAccionado::class);
        //$this->call(TutelaHechosTutela::class);
        //$this->call(TutelaPretensionesTutela::class);
        //$this->call(TutelaArgumentosTutela::class);
        //$this->call(TutelaHistorialPrimeraAsignacionTutela::class);
        //$this->call(TutelaAsignancionTareasTutela::class);
        //$this->call(PrimeraSentencia::class);
        //$this->call(PrimeraInstanciaResuelve::class);
        $this->call(Tabla_WikuAutores::class);
        $this->call(Tabla_WikuPalabras::class);
        $this->call(Tabla_WikuArgumentos::class);
        $this->call(Tabla_WikuPalabrasArgumentos::class);
        $this->call(Tabla_Motivotutelas::class);
        $this->call(Tabla_Submotivotutelas::class);
        //$this->call(Tabla_PQR_Peticiones_Hechos::class);
        //$this->call(Tabla_Peticiones_PQR::class);
        //$this->call(Tabla_Hechos_Peticiones_PQR::class);


    }

    protected function truncateTablas(array $tablas)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tablas as $tabla) {
            DB::table($tabla)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
