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
    //Descarga de pdf
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //guardar pdf PQR

});
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

Route::get('felicitacion_radicada_pdf/{id}', [EmailController::class, 'felicitacionRadicadaPdf'])->name('felicitacionRadicadaPdf');
Route::get('sugerencia_radicada_pdf/{id}', [EmailController::class, 'sugerenciaRadicadaPdf'])->name('sugerenciaRadicadaPdf');
Route::get('aclaracion_pdf/{id}', [EmailController::class, 'aclaracionPdf'])->name('aclaracionPdf');
Route::get('constancia_aclaracion_pdf/{id}', [EmailController::class, 'constancia_aclaracionPdf'])->name('constancia_aclaracionPdf');
Route::get('prorroga_pdf/{id}', [EmailController::class, 'prorrogaPdf'])->name('prorrogaPdf');
Route::get('recurso_pdf/{id}', [EmailController::class, 'recursoPdf'])->name('recursoPdf');
Route::get('asigacion_automatica/{id}', [PQRController::class, 'asigacion_automatica'])->name('asigacion_automatica');
