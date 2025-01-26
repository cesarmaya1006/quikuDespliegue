<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Intranet\Admin\RolController;
use App\Http\Controllers\Intranet\Admin\MenuController;
use App\Http\Controllers\Intranet\Email\EmailController;
use App\Http\Controllers\Extranet\ExtranetPageController;
use App\Http\Controllers\Intranet\Admin\AnaliticaController;
use App\Http\Controllers\Intranet\Admin\MenuRolController;
use App\Http\Controllers\Intranet\Admin\PermisoController;
use App\Http\Controllers\Intranet\Admin\UsuarioController;
use App\Http\Controllers\Intranet\Empresas\AreaController;
use App\Http\Controllers\Intranet\Empresas\SedeController;
use App\Http\Controllers\Intranet\Empresas\CargoController;
use App\Http\Controllers\Intranet\Empresas\NivelController;
use App\Http\Controllers\Intranet\Admin\CategoriaController;
use App\Http\Controllers\Intranet\Admin\PermisoRolController;
use App\Http\Controllers\Intranet\Funcionarios\PQRController;
use App\Http\Controllers\Intranet\Usuarios\ClienteController;
use App\Http\Controllers\Intranet\Admin\IntranetPageCotroller;
use App\Http\Controllers\Intranet\Admin\MarcaController;
use App\Http\Controllers\Intranet\Admin\ProductoController;
use App\Http\Controllers\Intranet\Admin\ReferenciaController;
use App\Http\Controllers\Intranet\Empresas\FuncionarioFController;
use App\Http\Controllers\Intranet\Empresas\WikuController;
use App\Http\Controllers\Intranet\Funcionarios\WikuEmpleadoController;
use App\Http\Controllers\Intranet\Funcionarios\FuncionarioController;
use App\Http\Controllers\Intranet\Funcionarios\AreasInfluenciaController;
use App\Http\Controllers\Intranet\Funcionarios\AsignacionParticularController;
use App\Http\Controllers\Intranet\Funcionarios\AsociacionTutelaWiku;
use App\Http\Controllers\Intranet\Funcionarios\EmpleadoWikuargumentoController;
use App\Http\Controllers\Intranet\Funcionarios\TutelaController;
use App\Http\Controllers\Intranet\Funcionarios\TutelasConsulta;
use App\Models\Tutela\TutelaRespuesta;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
});
Route::get('/migrar-bd', function () {
    echo Artisan::call('migrate:refresh');
});
//---------------------------------------------------------------------------------
Route::get('/', [ExtranetPageController::class, 'index'])->name('index');
Route::get('/index', [ExtranetPageController::class, 'index'])->name('index_2');
Route::get('/solicitar_password', [ExtranetPageController::class, 'solicitar_password'])->name('solicitar_password');
Route::post('/cambiar_password', [ExtranetPageController::class, 'cambiar_password'])->name('cambiar_password');
Route::get('/preguntas_frecuentes', [ExtranetPageController::class, 'preguntas_frecuentes'])->name('preguntas_frecuentes');
Route::get('/index3', [ExtranetPageController::class, 'index_3'])->name('index_3');
Route::get('/registro_ini', [ExtranetPageController::class, 'registro_ini'])->name('registro_ini');
Route::post('/registro_ini-guardar', [ExtranetPageController::class, 'registro_ini_guardar'])->name('registro_ini-guardar');
Route::get('/registro_ext/{id}/{cc}/{tipo}', [ExtranetPageController::class, 'registro_ext'])->name('registro_ext');
Route::get('/registro_conf', [ExtranetPageController::class, 'registro_conf'])->name('registro_conf');
Route::get('/parametros', [ExtranetPageController::class, 'parametros'])->name('parametros');
Route::post('/parametros-guardar', [ExtranetPageController::class, 'parametros_guardar'])->name('parametros-guardar');
Route::post('/registropj-guardar', [ExtranetPageController::class, 'registropj_guardar'])->name('registropj-guardar');
Route::post('/registrorep-guardar', [ExtranetPageController::class, 'registrorep_guardar'])->name('registrorep-guardar');
Route::post('/registropn-guardar', [ExtranetPageController::class, 'registropn_guardar'])->name('registropn-guardar');
Route::get('/registro_pj', [ExtranetPageController::class, 'registro_pj'])->name('registro_pj');
Route::get('/registro_rep/{id}', [ExtranetPageController::class, 'registro_rep'])->name('registro_rep');
Route::get('/registro_pn', [ExtranetPageController::class, 'registro_pn'])->name('registro_pn');
Route::get('/cargar_municipios', [ExtranetPageController::class, 'cargar_municipios'])->name('cargar_municipios');
Route::get('/cargar_sedes', [ExtranetPageController::class, 'cargar_sedes'])->name('cargar_sedes');
Route::post('/cargar_tipo_documentos', [ExtranetPageController::class, 'cargar_tipo_documentos'])->name('cargar_tipo_documentos');
Route::get('/registro_final_pn', [ExtranetPageController::class, 'registro_final_pn'])->name('registro_final_pn');
Route::get('/pruebamail', [ExtranetPageController::class, 'pruebamail'])->name('pruebamail');


//---------------------------------------------------------------------------------
Route::group(['middleware' => 'auth'], function () {
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    Route::group(['prefix' => 'admin'], function () {
        Route::get('index', [IntranetPageCotroller::class, 'index'])->name('admin-index');
        Route::post('restablecer-password', [IntranetPageCotroller::class, 'restablecer_password'])->name('admin-restablecer_password');
        Route::get('index/gestionarAsignacion/{id}', [FuncionarioController::class, 'gestionar_asignacion'])->name('funcionario-gestionar-asignacion');
        Route::get('index/gestionarAsignacionAsignador/{id}', [FuncionarioController::class, 'gestionar_asignacion_asignador'])->name('funcionario-gestionar-asignacion-asignador');
        Route::get('index/gestionarAsignacionSupervisa/{id}', [FuncionarioController::class, 'gestionar_asignacion_supervisa'])->name('funcionario-gestionar-asignacion-supervisa');
        Route::get('index/gestionarAsignacionProyecta/{id}', [FuncionarioController::class, 'gestionar_asignacion_proyecta'])->name('funcionario-gestionar-asignacion-proyecta');
        Route::get('index/gestionarAsignacionRevisa/{id}', [FuncionarioController::class, 'gestionar_asignacion_revisa'])->name('funcionario-gestionar-asignacion-revisa');
        Route::get('index/gestionarAsignacionAprueba/{id}', [FuncionarioController::class, 'gestionar_asignacion_aprueba'])->name('funcionario-gestionar-asignacion-aprueba');
        Route::get('index/gestionarAsignacionRevisaAprueba/{id}', [FuncionarioController::class, 'gestionar_asignacion_revisa_aprueba'])->name('funcionario-gestionar-asignacion-revisa-aprueba');
        Route::get('index/gestionarAsignacionRadica/{id}', [FuncionarioController::class, 'gestionar_asignacion_radica'])->name('funcionario-gestionar-asignacion-radica');
        Route::get('index/gestionarAsignacionColaboracion/{id}', [PQRController::class, 'gestionar_asignacion_colaboracion'])->name('funcionario-gestionar-asignacion-colaboracion');
        Route::get('index/gestionarAsignacionColaboracion_wiku/{id}', [PQRController::class, 'gestionar_asignacion_colaboracion_wiku'])->name('funcionario-gestionar-asignacion-colaboracion_wiku');
        //====================================================================================================================================================================================
        Route::get('index/gest_wiku_empleado/{id}', [WikuEmpleadoController::class, 'index'])->name('gest_wiku_empleado');
        //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        //argumentos
        Route::get('wiku_argcriterios_empleado/crear/{id}', [EmpleadoWikuargumentoController::class, 'crear'])->name('wiku_argcriterios_empleado-crear');
        Route::post('wiku_argcriterios_empleado-guardar/{id}', [EmpleadoWikuargumentoController::class, 'guardar'])->name('wiku_argcriterios_empleado-guardar');
        Route::get('wiku_argcriterios_empleado/editar/{id}/{id_arg}', [EmpleadoWikuargumentoController::class, 'editar'])->name('wiku_argcriterios_empleado-editar');
        Route::put('wiku_argcriterios_empleado-actualizar/{id}/{id_arg}', [EmpleadoWikuargumentoController::class, 'actualizar'])->name('wiku_argcriterios_empleado-actualizar');
        Route::get('wiku_argumentos_cambios/{id}', [EmpleadoWikuargumentoController::class, 'cambios'])->name('wiku_argumentos_cambios');
        Route::put('wiku_argumentos_cambios_aceptar/{id}', [EmpleadoWikuargumentoController::class, 'cambios_aceptar'])->name('wiku_argumentos_cambios_aceptar');

        //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        //====================================================================================================================================================================================
        Route::get('registro', [FuncionarioController::class, 'registro'])->name('funcionario-registro');
        Route::get('listado', [FuncionarioController::class, 'listado'])->name('tutela-listado');
        Route::get('listado/tutela/{id}', [TutelaController::class, 'vista_tutela'])->name('vista_tutela');
        Route::get('gestion', [FuncionarioController::class, 'gestion'])->name('tutela-gestion');
        Route::get('gestionar_asignacion_tutela/{id}', [FuncionarioController::class, 'gestionar_asignacion_tutela'])->name('gestionar_asignacion_tutela');
        Route::post('historial', [TutelaController::class, 'historial_tutela_guardar'])->name('historial_tutela_guardar');
        Route::post('asignacion', [TutelaController::class, 'asignacion_tutela_guardar'])->name('asignacion_tutela_guardar');
        Route::post('historial_tarea_tutela', [TutelaController::class, 'historial_tarea_tutela_guardar'])->name('historial_tarea_tutela_guardar');
        Route::get('gestionarAsignacionSupervisaTutela/{id}', [TutelaController::class, 'gestionar_asignacion_supervisa_tutela'])->name('gestionar_asignacion_supervisa_tutela');
        Route::get('gestionarAsignacionProyectaTutela/{id}', [TutelaController::class, 'gestionar_asignacion_proyecta_tutela'])->name('gestionar_asignacion_proyecta_tutela');
        Route::get('gestionarAsignacionRevisaApruebaTutela/{id}', [TutelaController::class, 'gestionar_asignacion_revisa_aprueba_tutela'])->name('gestionar_asignacion_revisa_aprueba_tutela');
        Route::get('gestionarAsignacionRadicaTutela/{id}', [TutelaController::class, 'gestionar_asignacion_radica_tutela'])->name('gestionar_asignacion_radica_tutela');
        Route::post('prioridad', [TutelaController::class, 'prioridad_tutela_guardar'])->name('prioridad_tutela_guardar');
        Route::post('estado_hecho', [TutelaController::class, 'estado_hecho_guardar'])->name('estado_hecho_guardar');
        Route::post('estado_pretension', [TutelaController::class, 'estado_pretension_guardar'])->name('estado_pretension_guardar');
        Route::post('estado_resuelve', [TutelaController::class, 'estado_resuelve_guardar'])->name('estado_resuelve_guardar');
        Route::post('asignacion_hecho', [TutelaController::class, 'asignacion_hecho_guardar'])->name('asignacion_hecho_guardar');
        Route::post('asignacion_pretension', [TutelaController::class, 'asignacion_pretension_guardar'])->name('asignacion_pretension_guardar');
        Route::post('asignacion_impugnacion', [TutelaController::class, 'asignacion_impugnacion_guardar'])->name('asignacion_impugnacion_guardar');

        Route::post('asignacion_resuelve', [TutelaController::class, 'asignacion_resuelve_guardar'])->name('asignacion_resuelve_guardar');
        Route::post('historial_hecho', [TutelaController::class, 'historial_hecho_guardar'])->name('historial_hecho_guardar');
        Route::post('historial_respuesta_hecho', [TutelaController::class, 'historial_respuesta_hecho_guardar'])->name('historial_respuesta_hecho_guardar');
        Route::post('historial_pretension', [TutelaController::class, 'historial_pretension_guardar'])->name('historial_pretension_guardar');
        Route::post('historial_respuesta_pretension', [TutelaController::class, 'historial_respuesta_pretension_guardar'])->name('historial_respuesta_pretension_guardar');
        Route::post('historial_respuesta_resuelve', [TutelaController::class, 'historial_respuesta_resuelve_guardar'])->name('historial_respuesta_resuelve_guardar');
        Route::get('gestionar_tutela/{id}', [TutelaController::class, 'gestionar_tutela'])->name('gestionar_tutela');
        Route::post('respuesta_pretension', [TutelaController::class, 'respuesta_pretension_guardar'])->name('respuesta_pretension_guardar');
        Route::post('respuesta_resuelve', [TutelaController::class, 'respuesta_resuelve_guardar'])->name('respuesta_resuelve_guardar');
        Route::post('respuesta_pretension_editar', [TutelaController::class, 'respuesta_pretension_editar_guardar'])->name('respuesta_pretension_editar_guardar');
        Route::post('respuesta_resuelve_editar', [TutelaController::class, 'respuesta_resuelve_editar_guardar'])->name('respuesta_resuelve_editar_guardar');
        Route::post('respuesta_hecho', [TutelaController::class, 'respuesta_hecho_guardar'])->name('respuesta_hecho_guardar');
        Route::post('respuesta_hecho_editar', [TutelaController::class, 'respuesta_hecho_editar_guardar'])->name('respuesta_hecho_editar_guardar');
        Route::post('respuesta_pretension_anexo', [TutelaController::class, 'respuesta_pretension_anexo_guardar'])->name('respuesta_pretension_anexo_guardar');
        Route::post('respuesta_resuelve_anexo', [TutelaController::class, 'respuesta_resuelve_anexo_guardar'])->name('respuesta_resuelve_anexo_guardar');
        Route::post('respuesta_hecho_anexo', [TutelaController::class, 'respuesta_hecho_anexo_guardar'])->name('respuesta_hecho_anexo_guardar');
        Route::post('relacion_respuesta_pretension', [TutelaController::class, 'relacion_respuesta_pretension_guardar'])->name('relacion_respuesta_pretension_guardar');
        Route::post('relacion_respuesta_resuelve', [TutelaController::class, 'relacion_respuesta_resuelve_guardar'])->name('relacion_respuesta_resuelve_guardar');
        Route::post('relacion_respuesta_hecho', [TutelaController::class, 'relacion_respuesta_hecho_guardar'])->name('relacion_respuesta_hecho_guardar');
        Route::post('estado_respuesta_pretension', [TutelaController::class, 'estado_respuesta_pretension_guardar'])->name('estado_respuesta_pretension_guardar');
        Route::post('estado_respuesta_resuelve', [TutelaController::class, 'estado_respuesta_resuelve_guardar'])->name('estado_respuesta_resuelve_guardar');
        Route::post('estado_respuesta_hecho', [TutelaController::class, 'estado_respuesta_hecho_guardar'])->name('estado_respuesta_hecho_guardar');
        Route::post('eliminar_respuesta_hecho', [TutelaController::class, 'eliminar_respuesta_hecho_guardar'])->name('eliminar_respuesta_hecho_guardar');
        Route::post('eliminar_respuesta_pretension', [TutelaController::class, 'eliminar_respuesta_pretension_guardar'])->name('eliminar_respuesta_pretension_guardar');
        Route::post('eliminar_respuesta_resuelve', [TutelaController::class, 'eliminar_respuesta_resuelve_guardar'])->name('eliminar_respuesta_resuelve_guardar');
        Route::get('respuestaTutela/{id}', [TutelaController::class, 'respuesta_tutela'])->name('respuesta_tutela');
        Route::get('respuestaSentenciaPrimeraInstancia/{id}', [TutelaController::class, 'respuesta_sentencia_primera_instancia'])->name('respuesta_sentencia_primera_instancia');
        Route::post('historial_resuelve_tutela', [TutelaController::class, 'historial_resuelve_tutela_guardar'])->name('historial_resuelve_tutela_guardar');
        Route::post('historial_resuelve_tutela_eliminar', [TutelaController::class, 'historial_resuelve_tutela_eliminar'])->name('historial_resuelve_tutela_eliminar');
        Route::post('resuelve_orden_tutela', [TutelaController::class, 'resuelve_orden_tutela_guardar'])->name('resuelve_orden_tutela_guardar');
        Route::post('tutela_respuesta_guardar', [TutelaController::class, 'tutela_respuesta_guardar'])->name('tutela_respuesta_guardar');
        Route::post('historial_resuelve_tutela_editar', [TutelaController::class, 'historial_resuelve_tutela_editar'])->name('historial_resuelve_tutela_editar');
        Route::post('cambiar_estado_tutela_tareas', [TutelaController::class, 'cambiar_estado_tareas_tutela_guardar'])->name('cambiar_estado_tareas_tutela_guardar');
        Route::get('descarga_respuesta_tutela/{id}', [TutelaController::class, 'descarga_respuesta_tutela'])->name('descarga_respuesta_tutela');
        Route::post('cambiosentidoresuelve/{id}', [TutelaController::class, 'cambiosentidoresuelve'])->name('cambiosentidoresuelve');
        Route::post('crearimpugnacion/{id}', [TutelaController::class, 'crearimpugnacion'])->name('crearimpugnacion');
        Route::post('verificar_sentencia_primera_instancia/{id}', [TutelaController::class, 'verificar_sentencia_primera_instancia'])->name('verificar_sentencia_primera_instancia');

        // Rutas Index
        // ------------------------------------------------------------------------------------
        Route::group(['middleware' => 'adminSistema'], function () {
            // Ruta Administrador del Sistema Menus
            // ------------------------------------------------------------------------------------
            Route::get('menu-index', [MenuController::class, 'index'])->name('admin-menu-index');
            Route::get('menu-crear', [MenuController::class, 'crear'])->name('admin-menu-crear');
            Route::get('menu/{id}/editar', [MenuController::class, 'editar'])->name('admin-menu-editar');
            Route::post('menu', [MenuController::class, 'guardar'])->name('admin-menu-guardar');
            Route::put('menu/{id}', [MenuController::class, 'actualizar'])->name('admin-menu-actualizar');
            Route::get('menu/{id}/eliminar', [MenuController::class, 'eliminar'])->name('admin-menu-eliminar');
            Route::get('menu-guardar-orden', [MenuController::class, 'guardarOrden'])->name('admin-menu-guardar-orden');
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Roles
            Route::get('rol-index', [RolController::class, 'index'])->name('admin-rol-index');
            Route::get('rol-crear', [RolController::class, 'crear'])->name('admin-rol-crear');
            Route::get('rol/{id}/editar', [RolController::class, 'editar'])->name('admin-rol-editar');
            Route::post('rol', [RolController::class, 'guardar'])->name('admin-rol-guardar');
            Route::put('rol/{id}', [RolController::class, 'actualizar'])->name('admin-rol-actualizar');
            Route::delete('rol/{id}/eliminar', [RolController::class, 'eliminar'])->name('admin-rol-eliminar');
            Route::get('roles/export/', [RolController::class, 'exportarExcel'])->name('roles-exportarExcel');
            // ------------------------------------------------------------------------------------
            /*RUTAS Administrador del Sistema MENU_ROL*/
            Route::get('_menus_rol', [MenuRolController::class, 'index'])->name('admin-menu_rol');
            Route::post('_menus_rol', [MenuRolController::class, 'guardar'])->name('admin-guardar_menu_rol');
            // ------------------------------------------------------------------------------------
            /*RUTAS DE PERMISO*/
            Route::get('permiso-index', [PermisoController::class, 'index'])->name('admin-permiso-index');
            Route::get('permiso-crear/{pagVolver?}', [PermisoController::class, 'crear'])->name('admin-crear_permiso');
            Route::post('permiso', [PermisoController::class, 'guardar'])->name('admin-guardar_permiso');
            Route::get('permiso/{id}/editar', [PermisoController::class, 'editar'])->name('admin-editar_permiso');
            Route::put('permiso/{id}', [PermisoController::class, 'actualizar'])->name('admin-actualizar_permiso');
            Route::delete('permiso/{id}', [PermisoController::class, 'eliminar'])->name('admin-eliminar_permiso');
            // ------------------------------------------------------------------------------------
            /*RUTAS PERMISO_ROL*/
            Route::get('_permiso-rol', [PermisoRolController::class, 'index'])->name('admin-permiso_rol');
            Route::post('_permiso-rol', [PermisoRolController::class, 'guardar'])->name('admin-guardar_permiso_rol');
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Usuarios
            Route::get('usuario-index', [UsuarioController::class, 'index'])->name('admin-usuario-index');
            Route::get('usuario-crear', [UsuarioController::class, 'crear'])->name('admin-usuario-crear');
            Route::post('usuario', [UsuarioController::class, 'guardar'])->name('admin-usuario-guardar');
            Route::get('usuario/{id}/editar', [UsuarioController::class, 'editar'])->name('admin-usuario-editar');
            Route::put('usuario/{id}', [UsuarioController::class, 'actualizar'])->name('admin-usuario-actualizar');
            Route::delete('usuario/{id}', [UsuarioController::class, 'eliminar'])->name('admin-usuario-eliminar');
            // ------------------------------------------------------------------------------------
            // Ruta Empresas
            Route::get('empresa-index', [EmpresaController::class, 'index'])->name('admin-empresa-index');
            Route::get('empresa-crear', [EmpresaController::class, 'crear'])->name('admin-empresa-crear');
            Route::post('empresa', [EmpresaController::class, 'guardar'])->name('admin-empresa-guardar');
            Route::get('empresa/{id}/editar', [EmpresaController::class, 'editar'])->name('admin-empresa-editar');
            Route::put('empresa/{id}', [EmpresaController::class, 'actualizar'])->name('admin-empresa-actualizar');
            Route::delete('empresa/{id}', [EmpresaController::class, 'eliminar'])->name('admin-empresa-eliminar');
            // ------------------------------------------------------------------------------------
        });
        // ------------------------------------------------------------------------------------
        Route::group(['middleware' => 'administrador'], function () {
            // Rutas Categorias
            Route::get('categorias-index', [CategoriaController::class, 'index'])->name('admin-categoria-index');
            Route::get('categorias-crear', [CategoriaController::class, 'crear'])->name('admin-categoria-crear');
            Route::get('categorias-editar/{id}', [CategoriaController::class, 'editar'])->name('admin-categoria-editar');
            Route::post('categorias-guardar', [CategoriaController::class, 'guardar'])->name('admin-categoria-guardar');
            Route::put('categorias-actualizar/{id}', [CategoriaController::class, 'actualizar'])->name('admin-categoria-actualizar');
            // Rutas Productos
            Route::get('productos-index', [ProductoController::class, 'index'])->name('admin-producto-index');
            Route::get('productos-crear', [ProductoController::class, 'crear'])->name('admin-producto-crear');
            Route::get('productos-editar/{id}', [ProductoController::class, 'editar'])->name('admin-producto-editar');
            Route::post('productos-guardar', [ProductoController::class, 'guardar'])->name('admin-producto-guardar');
            Route::put('productos-actualizar/{id}', [ProductoController::class, 'actualizar'])->name('admin-producto-actualizar');
            // Rutas Marcas
            Route::get('marcas-index', [MarcaController::class, 'index'])->name('admin-marca-index');
            Route::get('marcas-crear', [MarcaController::class, 'crear'])->name('admin-marca-crear');
            Route::get('marcas-editar/{id}', [MarcaController::class, 'editar'])->name('admin-marca-editar');
            Route::post('marcas-guardar', [MarcaController::class, 'guardar'])->name('admin-marca-guardar');
            Route::put('marcas-actualizar/{id}', [MarcaController::class, 'actualizar'])->name('admin-marca-actualizar');
            // Rutas Referencias
            Route::get('referencias-index', [ReferenciaController::class, 'index'])->name('admin-referencia-index');
            Route::get('referencias-crear', [ReferenciaController::class, 'crear'])->name('admin-referencia-crear');
            Route::get('referencias-editar/{id}', [ReferenciaController::class, 'editar'])->name('admin-referencia-editar');
            Route::post('referencias-guardar', [ReferenciaController::class, 'guardar'])->name('admin-referencia-guardar');
            Route::put('referencias-actualizar/{id}', [ReferenciaController::class, 'actualizar'])->name('admin-referencia-actualizar');

        });
        Route::group(['prefix' => 'funcionario'], function () {
            // Rutas parametrizacion
            // ------------------------------------------------------------------------------------
            // Rutas areas
            Route::get('areas-index', [AreaController::class, 'index'])->name('admin-funcionario-area-index');
            Route::get('areas-crear', [AreaController::class, 'crear'])->name('admin-funcionario-areas-crear');
            Route::get('areas-editar/{id}', [AreaController::class, 'editar'])->name('admin-funcionario-areas-editar');
            Route::post('areas-guardar', [AreaController::class, 'guardar'])->name('admin-funcionario-areas-guardar');
            Route::put('areas-actualizar/{id}', [AreaController::class, 'actualizar'])->name('admin-funcionario-areas-actualizar');
            // ------------------------------------------------------------------------------------
            // Rutas niveles
            Route::get('niveles-index', [NivelController::class, 'index'])->name('admin-funcionario-nivel-index');
            Route::get('niveles-crear', [NivelController::class, 'crear'])->name('admin-funcionario-niveles-crear');
            Route::get('niveles-editar/{id}', [NivelController::class, 'editar'])->name('admin-funcionario-niveles-editar');
            Route::post('niveles-guardar', [NivelController::class, 'guardar'])->name('admin-funcionario-niveles-guardar');
            Route::put('niveles-actualizar/{id}', [NivelController::class, 'actualizar'])->name('admin-funcionario-niveles-actualizar');
            // ------------------------------------------------------------------------------------
            // Rutas cargos
            Route::get('cargos-index', [CargoController::class, 'index'])->name('admin-funcionario-cargo-index');
            Route::get('cargos-crear', [CargoController::class, 'crear'])->name('admin-funcionario-cargos-crear');
            Route::get('cargos-editar/{id}', [CargoController::class, 'editar'])->name('admin-funcionario-cargos-editar');
            Route::post('cargos-guardar', [CargoController::class, 'guardar'])->name('admin-funcionario-cargos-guardar');
            Route::put('cargos-actualizar/{id}', [CargoController::class, 'actualizar'])->name('admin-funcionario-cargos-actualizar');
            Route::get('cargar_niveles', [CargoController::class, 'cargar_niveles'])->name('cargar_niveles');
            // ------------------------------------------------------------------------------------// ------------------------------------------------------------------------------------
            // Rutas Sedes
            Route::get('sedes-index', [SedeController::class, 'index'])->name('admin-funcionario-sedes-index');
            Route::get('sedes-crear', [SedeController::class, 'crear'])->name('admin-funcionario-sedes-crear');
            Route::get('sedes-editar/{id}', [SedeController::class, 'editar'])->name('admin-funcionario-sedes-editar');
            Route::post('sedes-guardar', [SedeController::class, 'guardar'])->name('admin-funcionario-sedes-guardar');
            Route::put('sedes-actualizar/{id}', [SedeController::class, 'actualizar'])->name('admin-funcionario-sedes-actualizar');
            Route::delete('sedes/{id}', [SedeController::class, 'eliminar'])->name('admin-funcionario-sedes-eliminar');
            // ------------------------------------------------------------------------------------// ------------------------------------------------------------------------------------
            // Rutas Areas de influencia
            Route::get('areas_influencia-index', [AreasInfluenciaController::class, 'index'])->name('admin-funcionario-areas_influencia-index');
            Route::post('areas_influencia', [AreasInfluenciaController::class, 'guardar'])->name('admin-funcionario-areas_influencia-guardar');
            // ------------------------------------------------------------------------------------
            // Rutas Asociacion wiku tutelas submotivos
            Route::get('asociacion-wiku-tutelas-index', [AsociacionTutelaWiku::class, 'index'])->name('admin-funcionario-asociacion_wiku_tutelas-index');
            Route::get('asociacion-wiku-tutelas-cargar_sub_motivo', [AsociacionTutelaWiku::class, 'cargar_sub_motivo'])->name('admin-funcionario-asociacion_wiku_tutelas-cargar_sub_motivo');
            Route::get('asociacion-wiku-tutelas-asociar', [AsociacionTutelaWiku::class, 'asociar'])->name('admin-funcionario-asociacion_wiku_tutelas-asociar');
            Route::delete('asociacion-wiku-tutelas/{wiku_argumento_id}/{submotivotutela_id}', [AsociacionTutelaWiku::class, 'eliminar'])->name('admin-funcionario-asociacion_wiku_tutelas-eliminar');
            Route::get('asociacion-wiku-tutelas-asociar_agumento/{wiku_argumento_id}', [AsociacionTutelaWiku::class, 'asociar_agumento'])->name('admin-funcionario-asociacion_wiku_tutelas-asociar_agumento');
            // ------------------------------------------------------------------------------------
            // Rutas Asignacion particular
            Route::get('asignacion_particular-index', [AsignacionParticularController::class, 'index'])->name('admin-funcionario-asignacion_particular-index');
            Route::get('asignacion_particular-crear', [AsignacionParticularController::class, 'crear'])->name('admin-funcionario-asignacion_particular-crear');
            Route::post('asignacion_particular', [AsignacionParticularController::class, 'guardar'])->name('admin-funcionario-asignacion_particular-guardar');
            // .-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
            Route::get('asignacion_particular-cargar_motivo', [AsignacionParticularController::class, 'cargar_motivo'])->name('admin-funcionario-asignacion_particular-cargar_motivo');
            Route::get('asignacion_particular-cargar_sub_motivo', [AsignacionParticularController::class, 'cargar_sub_motivo'])->name('admin-funcionario-asignacion_particular-cargar_sub_motivo');
            Route::get('asignacion_particular-cargar_producto', [AsignacionParticularController::class, 'cargar_producto'])->name('admin-funcionario-asignacion_particular-cargar_producto');
            Route::get('asignacion_particular-cargar_marca', [AsignacionParticularController::class, 'cargar_marca'])->name('admin-funcionario-asignacion_particular-cargar_marca');
            Route::get('asignacion_particular-cargar_referencia', [AsignacionParticularController::class, 'cargar_referencia'])->name('admin-funcionario-asignacion_particular-cargar_referencia');
            Route::get('asignacion_particular-cargar_municipio', [AsignacionParticularController::class, 'cargar_municipio'])->name('admin-funcionario-asignacion_particular-cargar_municipio');
            Route::get('asignacion_particular-cargar_sede', [AsignacionParticularController::class, 'cargar_sede'])->name('admin-funcionario-asignacion_particular-cargar_sede');
            Route::get('asignacion_particular-cargar_cargo', [AsignacionParticularController::class, 'cargar_cargo'])->name('admin-funcionario-asignacion_particular-cargar_cargo');
            // ------------------------------------------------------------------------------------
            //Gestión de funcionarios
            Route::get('funcionarios/index', [FuncionarioFController::class, 'index'])->name('funcionarios_funcionarios-index');
            Route::get('funcionarios/crear', [FuncionarioFController::class, 'crear'])->name('funcionarios_funcionarios-crear');
            Route::get('funcionarios/editar/{id}', [FuncionarioFController::class, 'editar'])->name('funcionarios_funcionarios-editar');
            Route::post('funcionarios-guardar', [FuncionarioFController::class, 'guardar'])->name('funcionarios_funcionarios-guardar');
            Route::put('funcionarios-actualizar/{id}', [FuncionarioFController::class, 'actualizar'])->name('funcionarios_funcionarios-actualizar');
            Route::get('funcionarios/{id}', [FuncionarioFController::class, 'activar'])->name('funcionarios_funcionarios-activar');
            Route::get('funcionarios-cargar_niveles', [FuncionarioFController::class, 'cargar_niveles'])->name('funcionarios_funcionarios-cargar_niveles');
            Route::get('funcionarios-cargar_cargos', [FuncionarioFController::class, 'cargar_cargos'])->name('funcionarios_funcionarios-cargar_cargos');
            // ------------------------------------------------------------------------------------
            //Gestión de wiku
            //=====================================================================================================================
            //Doctrinas
            Route::get('wiku_doctrina/crear', [WikuController::class, 'crear_doctrina'])->name('wiku_doctrina-crear');
            Route::post('wiku_doctrina-guardar', [WikuController::class, 'guardar_doctrina'])->name('wiku_doctrina-guardar');
            Route::get('wiku_doctrina/editar/{id}', [WikuController::class, 'editar_doctrina'])->name('wiku_doctrina-editar');
            Route::put('wiku_doctrina-actualizar/{id}', [WikuController::class, 'actualizar_doctrina'])->name('wiku_doctrina-actualizar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku_doccriterios/index/{id}/{wiku}', [WikuController::class, 'index_doccriterios'])->name('wiku_doccriterios-index');
            Route::get('wiku_doccriterios/crear/{id}/{wiku}', [WikuController::class, 'crear_doccriterios'])->name('wiku_doccriterios-crear');
            Route::post('wiku_doccriterios-guardar/{id}/{wiku}', [WikuController::class, 'guardar_doccriterios'])->name('wiku_doccriterios-guardar');
            Route::get('wiku_doccriterios/editar/{id_criterios}/{id}/{wiku}', [WikuController::class, 'editar_doccriterios'])->name('wiku_doccriterios-editar');
            Route::put('wiku_doccriterios-actualizar/{id_criterios}/{id}/{wiku}', [WikuController::class, 'actualizar_doccriterios'])->name('wiku_doccriterios-actualizar');
            Route::delete('wiku_doccriterios/{id}', [WikuController::class, 'wiku_doccriterios_eliminar'])->name('wiku_doccriterios-eliminar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku/docasociacion/crear/{id}/{wiku}', [WikuController::class, 'crear_docasociacion'])->name('wiku_docasociacion-crear');
            Route::post('wiku/docasociacion-guardar/{id}/{wiku}', [WikuController::class, 'guardar_docasociacion'])->name('wiku_docasociacion-guardar');
            Route::delete('wiku_docasociacion/{id}', [WikuController::class, 'wiku_docasociacion_eliminar'])->name('wiku_docasociacion-eliminar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            //Jurisprudencia
            Route::get('wiku_jurisprudencia/crear', [WikuController::class, 'crear_jurisprudencia'])->name('wiku_jurisprudencia-crear');
            Route::post('wiku_jurisprudencia-guardar', [WikuController::class, 'guardar_jurisprudencia'])->name('wiku_jurisprudencia-guardar');
            Route::get('wiku_jurisprudencia/editar/{id}', [WikuController::class, 'editar_jurisprudencia'])->name('wiku_jurisprudencia-editar');
            Route::put('wiku_jurisprudencia-actualizar/{id}', [WikuController::class, 'actualizar_jurisprudencia'])->name('wiku_jurisprudencia-actualizar');

            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            Route::get('wikucargarsalas', [WikuController::class, 'cargarSalas'])->name('wiku-cargarsalas');
            Route::get('wikucargarsubsalas', [WikuController::class, 'cargarsubsalas'])->name('wiku-cargarsubsalas');
            Route::get('wiku_jurisprudencia-cargarente', [WikuController::class, 'cargarente'])->name('wiku_jurisprudencia-cargarente');
            Route::get('wiku_jurisprudencia-cargarsala', [WikuController::class, 'crearSala'])->name('wiku_jurisprudencia-cargarsala');
            Route::get('wiku_jurisprudencia-cargarsubsala', [WikuController::class, 'crearSubSala'])->name('wiku_jurisprudencia-cargarsubsala');
            Route::get('wiku_jurisprudencia-crearmagistrado', [WikuController::class, 'crearMagistrado'])->name('wiku_jurisprudencia-crearmagistrado');
            Route::get('wiku_jurisprudencia-creardemandante', [WikuController::class, 'crearDemandante'])->name('wiku_jurisprudencia-creardemandante');
            Route::get('wiku_jurisprudencia-creardemandado', [WikuController::class, 'crearDemandado'])->name('wiku_jurisprudencia-creardemandado');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku/jurasociacion/crear/{id}/{wiku}', [WikuController::class, 'crear_jurasociacion'])->name('wiku_jurasociacion-crear');
            Route::post('wiku/jurasociacion-guardar/{id}/{wiku}', [WikuController::class, 'guardar_jurasociacion'])->name('wiku_jurasociacion-guardar');
            Route::delete('wiku_jurasociacion/{id}', [WikuController::class, 'wiku_jurasociacion_eliminar'])->name('wiku_jurasociacion-eliminar');
            // ------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------
            Route::get('wiku/index', [WikuController::class, 'index'])->name('wiku-index');
            Route::get('wiku/ver', [WikuController::class, 'ver'])->name('wiku-ver');
            Route::get('wikucargarargumentos', [WikuController::class, 'cargarArgumentos'])->name('wiku-cargarargumentos');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_argumento/crear', [WikuController::class, 'crear_argumento'])->name('wiku_argumento-crear');
            Route::post('wiku_argumento-guardar', [WikuController::class, 'guardar_argumento'])->name('wiku_argumento-guardar');
            Route::get('wiku_argumento/editar/{id}', [WikuController::class, 'editar_argumento'])->name('wiku_argumento-editar');
            Route::put('wiku_argumento-actualizar/{id}', [WikuController::class, 'actualizar_argumento'])->name('wiku_argumento-actualizar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku_argcriterios/index/{id}/{wiku}', [WikuController::class, 'index_argcriterios'])->name('wiku_argcriterios-index');
            Route::get('wiku_argcriterios/crear/{id}/{wiku}', [WikuController::class, 'crear_argcriterios'])->name('wiku_argcriterios-crear');
            Route::post('wiku_argcriterios-guardar/{id}/{wiku}', [WikuController::class, 'guardar_argcriterios'])->name('wiku_argcriterios-guardar');
            Route::get('wiku_argcriterios/editar/{id_criterios}/{id}/{wiku}', [WikuController::class, 'editar_argcriterios'])->name('wiku_argcriterios-editar');
            Route::put('wiku_argcriterios-actualizar/{id_criterios}/{id}/{wiku}', [WikuController::class, 'actualizar_argcriterios'])->name('wiku_argcriterios-actualizar');
            Route::delete('wiku_argcriterios/{id}', [WikuController::class, 'wiku_argcriterios_eliminar'])->name('wiku_argcriterios-eliminar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku_argumento-cargarautori', [WikuController::class, 'cargarautori'])->name('wiku_argumento-cargarautori');
            Route::get('wiku_argumento-cargarautor', [WikuController::class, 'cargarautor'])->name('wiku_argumento-cargarautor');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku/argasociacion/crear/{id}/{wiku}', [WikuController::class, 'crear_argasociacion'])->name('wiku_argasociacion-crear');
            Route::post('wiku/argasociacion-guardar/{id}/{wiku}', [WikuController::class, 'guardar_argasociacion'])->name('wiku_argasociacion-guardar');
            Route::delete('wiku_argasociacion/{id}', [WikuController::class, 'wiku_argasociacion_eliminar'])->name('wiku_argasociacion-eliminar');
            //=====================================================================================================================
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku_norma/crear', [WikuController::class, 'crear_norma'])->name('wiku_norma-crear');
            Route::post('wiku_norma-guardar', [WikuController::class, 'guardar_norma'])->name('wiku_norma-guardar');
            Route::get('wiku_norma/editar/{id}', [WikuController::class, 'editar_norma'])->name('wiku_norma-editar');
            Route::put('wiku_norma-actualizar/{id}', [WikuController::class, 'actualizar_norma'])->name('wiku_norma-actualizar');
            Route::get('cargar_temasespec', [WikuController::class, 'cargar_temasespec'])->name('cargar_temasespec');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_temaespecifico/{id}/{wiku}', [WikuController::class, 'volver_temaespecifico'])->name('wiku_volver_temaespecifico');
            Route::get('wiku_temaespecifico/index/{id}/{wiku}', [WikuController::class, 'index_temaespecifico'])->name('wiku_temaespecifico-index');
            Route::get('wiku_temaespecifico/crear/{id}/{wiku}', [WikuController::class, 'crear_temaespecifico'])->name('wiku_temaespecifico-crear');
            Route::post('wiku_temaespecifico-guardar/{id}/{wiku}', [WikuController::class, 'guardar_temaespecifico'])->name('wiku_temaespecifico-guardar');
            Route::get('wiku_temaespecifico/editar/{id_especifico}/{id}/{wiku}', [WikuController::class, 'editar_temaespecifico'])->name('wiku_temaespecifico-editar');
            Route::put('wiku_temaespecifico-actualizar/{id_especifico}/{id}/{wiku}', [WikuController::class, 'actualizar_temaespecifico'])->name('wiku_temaespecifico-actualizar');
            Route::get('cargar_temas', [WikuController::class, 'cargar_temas'])->name('cargar_temas');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_tema/{id}/{wiku}', [WikuController::class, 'volver_tema'])->name('wiku_volver_tema');
            Route::get('wiku_tema/index/{id}/{wiku}', [WikuController::class, 'index_tema'])->name('wiku_tema-index');
            Route::get('wiku_tema/crear/{id}/{wiku}', [WikuController::class, 'crear_tema'])->name('wiku_tema-crear');
            Route::post('wiku_tema-guardar/{id}/{wiku}', [WikuController::class, 'guardar_tema'])->name('wiku_tema-guardar');
            Route::get('wiku_tema/editar/{id_tema}/{id}/{wiku}', [WikuController::class, 'editar_tema'])->name('wiku_tema-editar');
            Route::put('wiku_tema-actualizar/{id_tema}/{id}/{wiku}', [WikuController::class, 'actualizar_tema'])->name('wiku_tema-actualizar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_area/{id}/{wiku}', [WikuController::class, 'volver_area'])->name('wiku_volver_area');
            Route::get('wiku_area/index/{id}/{wiku}', [WikuController::class, 'index_area'])->name('wiku_area-index');
            Route::get('wiku_area/crear/{id}/{wiku}', [WikuController::class, 'crear_area'])->name('wiku_area-crear');
            Route::post('wiku_area-guardar/{id}/{wiku}', [WikuController::class, 'guardar_area'])->name('wiku_area-guardar');
            Route::get('wiku_area/editar/{id_area}/{id}/{wiku}', [WikuController::class, 'editar_area'])->name('wiku_area-editar');
            Route::put('wiku_area-actualizar/{id_area}/{id}/{wiku}', [WikuController::class, 'actualizar_area'])->name('wiku_area-actualizar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_criterios/{id}/{wiku}', [WikuController::class, 'wiku_volver_criterios'])->name('wiku_volver_criterios');
            Route::get('wiku_criterios/index/{id}/{wiku}', [WikuController::class, 'index_criterios'])->name('wiku_criterios-index');
            Route::get('wiku_criterios/crear/{id}/{wiku}', [WikuController::class, 'crear_criterios'])->name('wiku_criterios-crear');
            Route::post('wiku_criterios-guardar/{id}/{wiku}', [WikuController::class, 'guardar_criterios'])->name('wiku_criterios-guardar');
            Route::get('wiku_criterios/editar/{id_criterios}/{id}/{wiku}', [WikuController::class, 'editar_criterios'])->name('wiku_criterios-editar');
            Route::put('wiku_criterios-actualizar/{id_criterios}/{id}/{wiku}', [WikuController::class, 'actualizar_criterios'])->name('wiku_criterios-actualizar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_palabras/{id}/{wiku}', [WikuController::class, 'wiku_volver_palabras'])->name('wiku_volver_palabras');
            Route::get('wiku_palabras/index/{id}/{wiku}', [WikuController::class, 'index_palabras'])->name('wiku_palabras-index');
            Route::get('wiku_palabras/crear/{id}/{wiku}', [WikuController::class, 'crear_palabras'])->name('wiku_palabras-crear');
            Route::post('wiku_palabras-guardar/{id}/{wiku}', [WikuController::class, 'guardar_palabras'])->name('wiku_palabras-guardar');
            Route::get('wiku_palabras/editar/{id_palabras}/{id}/{wiku}', [WikuController::class, 'editar_palabras'])->name('wiku_palabras-editar');
            Route::put('wiku_palabras-actualizar/{id_palabras}/{id}/{wiku}', [WikuController::class, 'actualizar_palabras'])->name('wiku_palabras-actualizar');
            Route::delete('wiku_palabras/{id}', [WikuController::class, 'wiku_palabras_eliminar'])->name('wiku_palabras-eliminar');
            Route::post('wiku_palabras/adicionar/{id_palabras}/{id}/{wiku}', [WikuController::class, 'adicionar_palabras'])->name('wiku_palabras-adicionar');
            Route::post('wiku_palabras/restar/{id_palabras}/{id}/{wiku}', [WikuController::class, 'restar_palabras'])->name('wiku_palabras-restar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku/index_fuenteN', [WikuController::class, 'index_fuenteN'])->name('wiku-index_fuenteN');
            Route::get('wiku_fuente/crear', [WikuController::class, 'crear_fuente'])->name('wiku_fuenteN-crear');
            Route::post('wiku_fuente-guardar', [WikuController::class, 'guardar_fuenteN'])->name('wiku_fuenteN-guardar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_asociacion/{id}/{wiku}', [WikuController::class, 'wiku_volver_asociacion'])->name('wiku_volver_asociacion');
            Route::get('wiku/asociacion/crear/{id}/{wiku}', [WikuController::class, 'crear_asociacion'])->name('wiku_asociacion-crear');
            Route::post('wiku/asociacion-guardar/{id}/{wiku}', [WikuController::class, 'guardar_asociacion'])->name('wiku_asociacion-guardar');
            Route::delete('wiku_asociacion/{id}', [WikuController::class, 'wiku_asociacion_eliminar'])->name('wiku_asociacion-eliminar');

            // Gestion de analitica
            Route::get('analitica/index', [AnaliticaController::class, 'index'])->name('analitica-index');
            Route::get('analitica/index/cantidad', [AnaliticaController::class, 'cantidad'])->name('analitica-cantidad');
            Route::get('analitica/tipoPQR', [AnaliticaController::class, 'tipoPQR'])->name('analitica-tipoPQR');
            Route::get('analitica/cantidad_cargar', [AnaliticaController::class, 'cantidad_cargar'])->name('analitica-cantidad_cargar');
        });
    });
    //==================================================================================================================
    Route::group(['prefix' => 'funcionario'], function () {

        Route::get('gestion_pqr', [PQRController::class, 'gestion_pqr'])->name('gestion_pqr');


        Route::get('/cargar_nombre_despachos', [TutelaController::class, 'cargar_nombre_despachos'])->name('cargar_nombre_despachos');
        Route::get('/cargar_ubicacion_despachos', [TutelaController::class, 'cargar_ubicacion_despachos'])->name('cargar_ubicacion_despachos');
        Route::post('crear_auto_admisorio', [TutelaController::class, 'crear_auto_admisorio'])->name('crear_auto_admisorio');
        Route::post('update_auto_admisorio', [TutelaController::class, 'update_auto_admisorio'])->name('update_auto_admisorio');
        Route::post('update_tutela', [TutelaController::class, 'update_tutela'])->name('update_tutela');
        Route::post('crear_accion', [TutelaController::class, 'crear_accion'])->name('crear_accion');
        Route::post('crear_motivos_tutela', [TutelaController::class, 'crear_motivos_tutela'])->name('crear_motivos_tutela');
        Route::post('crear_anexo_tutela', [TutelaController::class, 'crear_anexo_tutela'])->name('crear_anexo_tutela');
        Route::get('auto_admisorio_complemento/{id}', [TutelaController::class, 'auto_admisorio_complemento'])->name('auto_admisorio_complemento');
        Route::post('crear_hechos_tutela', [TutelaController::class, 'crear_hechos_tutela'])->name('crear_hechos_tutela');
        Route::post('crear_pretensiones_tutela', [TutelaController::class, 'crear_pretensiones_tutela'])->name('crear_pretensiones_tutela');
        Route::post('crear_argumentos_tutela', [TutelaController::class, 'crear_argumentos_tutela'])->name('crear_argumentos_tutela');
        Route::post('crear_pruebas_tutela', [TutelaController::class, 'crear_pruebas_tutela'])->name('crear_pruebas_tutela');
        Route::post('asignacion_tarea_tutela', [TutelaController::class, 'asignacion_tarea_tutela_guardar'])->name('asignacion_tarea_tutela_guardar');
        // Route::get('index', [IntranetPageCotroller::class, 'index'])->name('admin-index');
        //Wiku
        Route::get('wiku-index', [WikuController::class, 'indexWiku'])->name('wiku_funcionario-index');
        Route::get('wiku-busqueda_inicial', [WikuController::class, 'WikuBusquedaInicial'])->name('wiku_busqueda_inicial');
        Route::get('wiku-busqueda_basica', [WikuController::class, 'WikuBusquedaBasica'])->name('wiku_busqueda_basica');
        Route::get('wiku-busqueda_avanzadaa', [WikuController::class, 'WikuBusquedaAvanzada'])->name('wiku_busqueda_avanzada');

        Route::get('cargar_normas', [WikuController::class, 'cargar_normas'])->name('cargar_normas');
        Route::get('cargar_salas', [WikuController::class, 'cargar_salas'])->name('cargar_salas');
        Route::get('cargar_subsalas', [WikuController::class, 'cargar_subsalas'])->name('cargar_subsalas');
        //----------------------------------------------------------------------------------------------------
        Route::get('wiku-normas/index', [WikuController::class, 'indexWikuNormas'])->name('wiku_funcionario_norma_index');
        //----------------------------------------------------------------------------------------------------
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Route::get('listado', [FuncionarioController::class, 'index'])->name('funcionario-index');
        Route::get('crear-usuario', [FuncionarioController::class, 'crear_usuario'])->name('funcionario-crear_usuario');
        Route::get('crear-usuario-creado/{id}', [FuncionarioController::class, 'usuario_creado'])->name('funcionario-usuario_creado');
        Route::post('crear-usuario', [FuncionarioController::class, 'registro_asistido'])->name('funcionario-registro_asistido');
        Route::get('actualizar-datos', [FuncionarioController::class, 'editar'])->name('funcionario-editar');
        Route::post('actualizar-datos', [FuncionarioController::class, 'actualizar'])->name('funcionario-actualizar');
        Route::get('cambiar-password', [FuncionarioController::class, 'cambiar_password'])->name('funcionario-cambiar-password');
        Route::get('usuarios-listado', [FuncionarioController::class, 'listado_usuarios'])->name('funcionario-listado-usuarios');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Route::post('respuesta_recurso_guardar', [PQRController::class, 'respuesta_recurso_guardar'])->name('respuesta_recurso_guardar');
        Route::post('respuesta_recurso_actualizar', [PQRController::class, 'respuesta_recurso_actualizar'])->name('respuesta_recurso_actualizar');
        Route::post('respuesta_recurso_anexos', [PQRController::class, 'respuesta_recurso_anexos_guardar'])->name('respuesta_recurso_anexos_guardar');
        Route::post('asignacion', [PQRController::class, 'asignacion_guardar'])->name('asignacion_guardar');
        Route::post('asignacion_asignador', [PQRController::class, 'asignacion_asignador_guardar'])->name('asignacion_asignador_guardar');
        Route::post('historial', [PQRController::class, 'historial_guardar'])->name('historial_guardar');
        Route::post('historial_tarea', [PQRController::class, 'historial_tarea_guardar'])->name('historial_tarea_guardar');
        Route::post('historial_resuelve', [PQRController::class, 'historial_resuelve_guardar'])->name('historial_resuelve_guardar');
        Route::post('historial_resuelve_recurso', [PQRController::class, 'historial_resuelve_recurso_guardar'])->name('historial_resuelve_recurso_guardar');
        Route::post('historial_resuelve_eliminar', [PQRController::class, 'historial_resuelve_eliminar'])->name('historial_resuelve_eliminar');
        Route::post('historial_resuelve_recurso_eliminar', [PQRController::class, 'historial_resuelve_recurso_eliminar'])->name('historial_resuelve_recurso_eliminar');
        Route::post('historial_resuelve_editar', [PQRController::class, 'historial_resuelve_editar'])->name('historial_resuelve_editar');
        Route::post('historial_resuelve_recurso_editar', [PQRController::class, 'historial_resuelve_recurso_editar'])->name('historial_resuelve_recurso_editar');
        Route::post('resuelve_orden', [PQRController::class, 'resuelve_orden_guardar'])->name('resuelve_orden_guardar');
        Route::post('resuelve_orden_recurso', [PQRController::class, 'resuelve_orden_recurso_guardar'])->name('resuelve_orden_recurso_guardar');
        Route::post('historial_peticion', [PQRController::class, 'historial_peticion_guardar'])->name('historial_peticion_guardar');
        Route::post('asignacion_tarea', [PQRController::class, 'asignacion_tarea_guardar'])->name('asignacion_tarea_guardar');
        Route::post('asignacion_peticion', [PQRController::class, 'asignacion_peticion_guardar'])->name('asignacion_peticion_guardar');
        Route::post('prioridad', [PQRController::class, 'prioridad_guardar'])->name('prioridad_guardar');
        Route::post('estado', [PQRController::class, 'estado_guardar'])->name('estado_guardar');
        Route::post('aclaracion', [PQRController::class, 'aclaracion_guardar'])->name('aclaracion_guardar');
        Route::post('prorroga', [PQRController::class, 'prorroga_guardar'])->name('prorroga_guardar');
        Route::post('respuesta', [PQRController::class, 'respuesta_guardar'])->name('respuesta_guardar');
        Route::post('respuesta_anexo', [PQRController::class, 'respuesta_anexo_guardar'])->name('respuesta_anexo_guardar');
        Route::post('plazo_recurso', [PQRController::class, 'plazo_recurso_guardar'])->name('plazo_recurso_guardar');
        Route::get('cargar_tareas', [PQRController::class, 'cargar_tareas'])->name('cargar_tareas');
        Route::get('cargar_cargos', [PQRController::class, 'cargar_cargos'])->name('cargar_cargos');
        Route::get('cargar_funcionarios', [PQRController::class, 'cargar_funcionarios'])->name('cargar_funcionarios');
        Route::post('pqr_anexo', [PQRController::class, 'pqr_anexo_guardar'])->name('pqr_anexo_guardar');
        Route::get('respuestaPQR/{id}', [PQRController::class, 'respuestaPQR'])->name('respuestaPQR');
        Route::get('respuestaPQRRecurso/{id}/{tipo_recurso}', [PQRController::class, 'respuestaPQRRecurso'])->name('respuestaPQRRecurso');
        Route::get('descarga_respuestaPQR/{id}', [PQRController::class, 'descarga_respuestaPQR'])->name('descarga_respuestaPQR');
        Route::get('usuario_descarga_respuestaPQR/{id}', [PQRController::class, 'usuario_descarga_respuestaPQR'])->name('usuario_descarga_respuestaPQR');
        Route::post('cambiar_estado_tareas', [PQRController::class, 'cambiar_estado_tareas_guardar'])->name('cambiar_estado_tareas_guardar');
        Route::get('cambiar-password-asistido/{id}', [ClienteController::class, 'cambiar_password_asistido'])->name('funcionario_cambiar_password_asistido');
        //==================================================================================================================
        Route::get('consulta', [TutelasConsulta::class, 'index'])->name('index_consulta');
        Route::get('cargar_tutelas', [TutelasConsulta::class, 'cargar_tutelas'])->name('cargar_tutelas');
        Route::get('consulta/detalles_tutelas/{id}', [TutelasConsulta::class, 'detalles_tutelas'])->name('detalles_tutelas');
        //==================================================================================================================
        Route::get('consulta/tutelas/primera-instancia/{id}', [TutelasConsulta::class, 'tutelas_primera_instancia'])->name('tutelas_primera_instancia');
        Route::post('consulta/tutelas/primera-instancia/guardar/{id}', [TutelasConsulta::class, 'tutelas_primera_instancia_guardar'])->name('tutelas_primera_instancia_guardar');
        //==================================================================================================================
        Route::get('consulta/tutelas/segunda-instancia/{id}', [TutelasConsulta::class, 'tutelas_segunda_instancia'])->name('tutelas_segunda_instancia');
        Route::post('consulta/tutelas/segunda-instancia/guardar/{id}', [TutelasConsulta::class, 'tutelas_segunda_instancia_guardar'])->name('tutelas_segunda_instancia_guardar');
        //==================================================================================================================
        Route::get('consulta/tutelas/impugnacion/{id}', [TutelasConsulta::class, 'tutelas_impugnacion'])->name('tutelas_impugnacion');
        Route::get('consulta/tutelas/impugnacion/gestion/{id}', [TutelasConsulta::class, 'tutelas_impugnacion_gestion'])->name('tutelas_impugnacion_gestion');
        Route::get('consulta/tutelas/impugnacion/registro/{id}', [TutelasConsulta::class, 'tutelas_impugnacion_registro'])->name('tutelas_impugnacion_registro');
        Route::post('consulta/tutelas/impugnacion/guardar', [TutelasConsulta::class, 'tutelas_impugnacion_guardar'])->name('tutelas_impugnacion_guardar');

        //==================================================================================================================
    });
    //==================================================================================================================
    Route::group(['prefix' => 'usuario'], function () {
        Route::get('listado', [ClienteController::class, 'index'])->name('usuario-index');
        Route::get('generar', [ClienteController::class, 'generar'])->name('usuario-generar');
        Route::post('generar', [ClienteController::class, 'direccion'])->name('usuario-generar_direccion');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // Nuevas Rutas
        Route::post('listado/gestionarPQR', [PQRController::class, 'gestionar_guardar_usuario'])->name('usuario_gestionar_pqr_guardar');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        Route::get('generarPQR/{id}', [ClienteController::class, 'generarPQR'])->name('usuario-generarPQR');
        Route::post('generarPQR', [ClienteController::class, 'generarPQR_guardar'])->name('usuario-generarPQR-guardar');
        Route::get('generarPQR-motivos/{id}', [ClienteController::class, 'generarPQR_motivos'])->name('usuario-generarPQR_motivos');
        Route::post('generarPQR-motivos', [ClienteController::class, 'generarPQR_motivos_guardar'])->name('usuario-generarPQR_motivos-guardar');
        Route::get('cargar_submotivos', [ClienteController::class, 'cargar_submotivos'])->name('cargar_submotivos');
        Route::get('cargar_productos', [ClienteController::class, 'cargar_productos'])->name('cargar_productos');
        Route::get('cargar_marcas', [ClienteController::class, 'cargar_marcas'])->name('cargar_marcas');
        Route::get('cargar_referencias', [ClienteController::class, 'cargar_referencias'])->name('cargar_referencias');
        //----------------------------------------------------------------------------------------------------------------
        Route::get('listado/gestionarPQR/{id}', [ClienteController::class, 'gestionar_PQR'])->name('usuario-gestionarPQR');
        Route::post('recurso', [PQRController::class, 'recurso_guardar'])->name('recurso_guardar');
        Route::post('recurso_anexos', [PQRController::class, 'recurso_anexos_guardar'])->name('recurso_anexos_guardar');
        Route::post('pqr_estado_recurso', [PQRController::class, 'pqr_estado_recurso_guardar'])->name('pqr_estado_recurso_guardar');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Route::get('generarConceptoUOpinion', [ClienteController::class, 'generarConceptoUOpinion'])->name('usuario-generarConceptoUOpinion');
        Route::post('generarConceptoUOpinion', [ClienteController::class, 'generarConceptoUOpinion_guardar'])->name('usuario-generarConceptoUOpinion-guardar');
        Route::get('listado/gestionarConceptoUOpinion/{id}', [ClienteController::class, 'gestionar_conceptoUOpinion'])->name('usuario-gestionarConceptoUOpinion');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Route::get('generarFelicitacion', [ClienteController::class, 'generarFelicitacion'])->name('usuario-generarFelicitacion');
        Route::post('generarFelicitacion', [ClienteController::class, 'generarFelicitacion_guardar'])->name('usuario-generarFelicitacion-guardar');
        Route::get('listado/gestionarFelicitaciones/{id}', [ClienteController::class, 'gestionar_felicitaciones'])->name('usuario-gestionarFelicitacion');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Route::get('gererarDenuncia', [ClienteController::class, 'gererarDenuncia'])->name('usuario-gererarDenuncia');
        Route::post('gererarDenuncia', [ClienteController::class, 'gererarDenuncia_guardar'])->name('usuario-gererarDenuncia-guardar');
        Route::get('listado/gestionarReporte/{id}', [ClienteController::class, 'gestionar_reporteDeIrregularidad'])->name('usuario-gestionarReporte');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Route::get('generarSolicitudDatos', [ClienteController::class, 'generarSolicitudDatos'])->name('usuario-generarSolicitudDatos');
        Route::post('generarSolicitudDatos', [ClienteController::class, 'generarSolicitudDatos_guardar'])->name('usuario-generarSolicitudDatos-guardar');
        Route::get('listado/gestionarSolicitudDatos/{id}', [ClienteController::class, 'gestionar_solicitudDatos'])->name('usuario-gestionarSolicitudDatos');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Route::get('generarSolicitudDocumentos', [ClienteController::class, 'generarSolicitudDocumentos'])->name('usuario-generarSolicitudDocumentos');
        Route::post('generarSolicitudDocumentos', [ClienteController::class, 'generarSolicitudDocumentos_guardar'])->name('usuario-generarSolicitudDocumentos-guardar');
        Route::get('listado/gestionarSolicitudDocInfo/{id}', [ClienteController::class, 'gestionar_solicitudDocInfo'])->name('usuario-gestionarSolicitudDocInfo');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Route::get('generarSugerencia', [ClienteController::class, 'generarSugerencia'])->name('usuario-generarSugerencia');
        Route::post('generarSugerencia', [ClienteController::class, 'generarSugerencia_guardar'])->name('usuario-generarSugerencia-guardar');
        Route::get('listado/gestionarSugerencia/{id}', [ClienteController::class, 'gestionar_sugerencia'])->name('usuario-gestionarsugerencia');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Route::post('aclaracion_usuario', [PQRController::class, 'aclaracion_usuario_guardar'])->name('aclaracion_usuario_guardar');
        Route::post('aclaracion_anexos_usuario', [PQRController::class, 'aclaracion_anexos_usuario_guardar'])->name('aclaracion_anexos_usuario_guardar');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //Actualizar datos
        Route::get('actualizar-datos', [ClienteController::class, 'actualizar_datos'])->name('usuario-actualizar_datos');
        Route::post('actualizar-datos', [ClienteController::class, 'actualizar'])->name('usuario-actualizar');

        //Cambiar password
        Route::get('cambiar-password', [ClienteController::class, 'cambiar_password'])->name('usuario_cambiar_password');

        //Crear usuario asistido
        Route::get('crear-usuario', [ClienteController::class, 'crear_usuario'])->name('usuario_crear_usuario');

        //Consultar politicas
        Route::get('consulta-politicas', [ClienteController::class, 'consulta_politicas'])->name('usuario_consulta_politicas');

        //Consultar ayuda
        Route::get('ayuda', [ClienteController::class, 'ayuda'])->name('usuario_ayuda');
    });
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //Consultar ayuda
    Route::get('download/{id_tipo_pqr}/{id_pqr}', [ClienteController::class, 'download'])->name('download');
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //Descarga de pdf
    Route::get('pqr_radicada_pdf/{id}', [EmailController::class, 'pqrRadicadaPdf'])->name('pqrRadicadaPdf');
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //guardar pdf PQR
    Route::get('pqr_pdf_guardar', [EmailController::class, 'pqr_pdf_guardar'])->name('pqr_pdf_guardar');
    Route::group(['middleware' => 'administrador'], function () {
        // Gestion de analitica
        Route::get('analitica', [AnaliticaController::class, 'index'])->name('analitica-index');
        Route::get('analitica/cantidad', [AnaliticaController::class, 'cantidad'])->name('analitica-cantidad');
        Route::post('analitica/cargar_graficos', [AnaliticaController::class, 'cargar_graficos'])->name('analitica-cargar_graficos');
        //=======================================================================================
        //Route::get('analitica/index/cantidad', [AnaliticaController::class, 'cantidad'])->name('analitica-cantidad');
        Route::get('analitica/tipoPQR', [AnaliticaController::class, 'tipoPQR'])->name('analitica-tipoPQR');
        Route::get('analitica/cantidad_cargar', [AnaliticaController::class, 'cantidad_cargar'])->name('analitica-cantidad_cargar');

    });
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

});
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

Route::get('felicitacion_radicada_pdf/{id}', [EmailController::class, 'felicitacionRadicadaPdf'])->name('felicitacionRadicadaPdf');
Route::get('sugerencia_radicada_pdf/{id}', [EmailController::class, 'sugerenciaRadicadaPdf'])->name('sugerenciaRadicadaPdf');
Route::get('aclaracion_pdf/{id}', [EmailController::class, 'aclaracionPdf'])->name('aclaracionPdf');
Route::get('constancia_aclaracion_pdf/{id}', [EmailController::class, 'constancia_aclaracionPdf'])->name('constancia_aclaracionPdf');
Route::get('prorroga_pdf/{id}', [EmailController::class, 'prorrogaPdf'])->name('prorrogaPdf');
Route::get('recurso_pdf/{id}', [EmailController::class, 'recursoPdf'])->name('recursoPdf');
Route::get('asigacion_automatica/{id}', [PQRController::class, 'asigacion_automatica'])->name('asigacion_automatica');
