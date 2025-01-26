<?php

namespace App\Http\Controllers\Intranet\Funcionarios;

use App\Models\PQR\tipoPQR;
use App\Models\Tutela\Tarea;
use Illuminate\Http\Request;
use App\Models\PQR\Prioridad;
use App\Models\Admin\WikuArea;
use App\Models\Tutela\Accions;
use App\Models\Tutela\Acccions;
use App\Models\Tutela\Despachos;
use App\Models\Admin\WikuDocument;
use App\Models\Servicios\Servicio;
use App\Models\Tutela\AnexoTutela;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Productos\Categoria;
use App\Models\Tutela\HechosTutela;
use App\Http\Controllers\Controller;
use App\Models\Admin\WikuArgumento;
use App\Models\Admin\WikuDoctrina;
use App\Models\Admin\WikuJurisprudencia;
use App\Models\Admin\WikuNorma;
use App\Models\PQR\SubMotivo;
use App\Models\Tutela\AutoAdmisorio;
use App\Models\Tutela\MotivosTutela;
use App\Models\Tutela\PruebasTutela;
use App\Models\Tutela\RelacionHecho;
use App\Models\Tutela\HistorialHecho;
use App\Models\Tutela\ResuelveTutela;
use App\Models\Tutela\AsignacionTarea;
use App\Models\Tutela\HistorialTareas;
use App\Models\Tutela\RespuestaHechos;
use App\Models\Tutela\TutelaRespuesta;
use Illuminate\Support\Facades\Config;
use App\Models\Tutela\ArgumentosTutela;
use App\Models\Tutela\PrimeraInstancia;
use App\Models\Tutela\AsignacionEstados;
use App\Models\Tutela\DocRespuestaHecho;
use App\Models\Tutela\ImpugnacionInterna;
use App\Models\Tutela\PretensionesTutela;
use App\Models\Tutela\RelacionPretension;
use App\Models\Tutela\HistorialAsignacion;
use App\Models\Tutela\HistorialPretension;
use App\Models\Tutela\RelacionesImpugnacion;
use App\Models\Tutela\RespuestaPretensiones;
use App\Models\Tutela\DocRespuestaPretension;
use App\Models\Tutela\RespuestaImpugnaciones;
use App\Models\Tutela\DocRespuestaImpugnacion;
use App\Models\Tutela\HistorialRespuestaHecho;
use App\Models\Tutela\ResuelvePrimeraInstancia;
use App\Models\Tutela\HistorialRespuestaPretension;
use App\Models\Tutela\HistorialRespuestaImpugnacion;
use App\Models\Tutela\Motivotutela;
use App\Models\Tutela\Submotivotutela;

class TutelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gestionar_tutela($id)
    {
        $areas = WikuArea::all();
        $fuentes = WikuDocument::all();
        $tipos_pqr = tipoPQR::get();
        $categorias = Categoria::get();
        $servicios = Servicio::get();
        $tutela = AutoAdmisorio::findorFail($id);
        $estados = AsignacionEstados::all();

        //-----------------------------------------------------
        //-----------------------------------------------------
        $auto_admisorio_id = $tutela->id;
        $submotivos = Submotivotutela::whereHas('tutelas', function ($q) use ($auto_admisorio_id) {
            $q->where('auto_admisorio_id',  $auto_admisorio_id);
        })->get();

        //-----------------------------------------------------
        $normasArray = [];
        foreach ($submotivos as $submotivo) {
            $submotivotutela_id = $submotivo->id;
            //= = = = = = =
            $normas_temp = WikuNorma::whereHas('asociacion_submotivotutelas', function ($p) use ($submotivotutela_id) {
                $p->where('submotivotutela_id',  $submotivotutela_id);
            })->get();
            foreach ($normas_temp as $key => $norma_temp) {
                $normasArray[] = $norma_temp->id;
            }
        }
        //-----------------------------------------------------
        $jurisprudenciasArray = [];
        foreach ($submotivos as $submotivo) {
            $submotivotutela_id = $submotivo->id;
            //= = = = = = =
            $jurisprudencias_temp = WikuJurisprudencia::whereHas('asociacion_submotivotutelas', function ($p) use ($submotivotutela_id) {
                $p->where('submotivotutela_id',  $submotivotutela_id);
            })->get();
            foreach ($jurisprudencias_temp as $key => $jurisprudencia_temp) {
                $jurisprudenciasArray[] = $jurisprudencia_temp->id;
            }
        }
        //-----------------------------------------------------
        $argumentosArray = [];
        foreach ($submotivos as $submotivo) {
            $submotivotutela_id = $submotivo->id;
            //= = = = = = =
            $argumentos_temp = WikuArgumento::whereHas('asociacion_submotivotutelas', function ($p) use ($submotivotutela_id) {
                $p->where('submotivotutela_id',  $submotivotutela_id);
            })->get();
            foreach ($argumentos_temp as $key => $argumento_temp) {
                $argumentosArray[] = $argumento_temp->id;
            }
        }
        //-----------------------------------------------------
        $doctrinasArray = [];
        foreach ($submotivos as $submotivo) {
            $submotivotutela_id = $submotivo->id;
            //= = = = = = =
            $doctrinas_temp = WikuDoctrina::whereHas('asociacion_submotivotutelas', function ($p) use ($submotivotutela_id) {
                $p->where('submotivotutela_id',  $submotivotutela_id);
            })->get();
            foreach ($doctrinas_temp as $key => $doctrina_temp) {
                $doctrinasArray[] = $doctrina_temp->id;
            }
        }
        $normas = WikuNorma::whereIn('id', $normasArray)->get();
        $jurisprudencias = WikuJurisprudencia::whereIn('id', $jurisprudenciasArray)->get();
        $argumentos = WikuArgumento::whereIn('id', $argumentosArray)->get();
        $doctrinas = WikuDoctrina::whereIn('id', $doctrinasArray)->get();
        /*foreach ($argumentos as $argumento) {
            dd($argumento->temaEspecifico->tema_->area->area);

        }*/

        //-----------------------------------------------------
        return view('intranet.funcionarios.tutela.tutela_tareas.gestion_colaboracion', compact('tutela', 'estados', 'areas', 'fuentes', 'tipos_pqr', 'servicios', 'categorias', 'normas', 'jurisprudencias', 'argumentos', 'doctrinas'));
    }

    public function auto_admisorio_complemento($id)
    {
        $motivos = Motivotutela::all();
        return view('intranet.funcionarios.tutela.registro_complemento', compact('id', 'motivos'));
    }

    public function crear_auto_admisorio(Request $request)
    {
        if ($request->ajax()) {
            $nuevo_auto_admisorio['unidad_negocio_id'] = 1;
            $nuevo_auto_admisorio['empleado_rigistro_id'] = session('id_usuario');
            $nuevo_auto_admisorio['estadostutela_id'] = 1;
            $nuevo_auto_admisorio['radicado'] = $request['radicado'];
            $nuevo_auto_admisorio['jurisdiccion'] = $request['jurisdiccion'];
            $despacho =  Despachos::findOrFail($request["juzgado"]);
            $nuevo_auto_admisorio['juzgado'] = $despacho['nombre_despacho'];
            $nuevo_auto_admisorio['departamento'] = $despacho['departamento'];
            $nuevo_auto_admisorio['municipio'] = $despacho['municipio'];
            $nuevo_auto_admisorio['fecha_notificacion'] = $request['fecha_notificacion'];

            $nuevo_auto_admisorio['nombre_juez'] = $request['nombreApellido_juez'];
            $nuevo_auto_admisorio['direccion_juez'] = $request['direccion_juez'];
            $nuevo_auto_admisorio['telefono_juez'] = $request['telefono_fijo_juez'];
            $nuevo_auto_admisorio['correo_juez'] = $request['correo_juez'];


            $nuevo_auto_admisorio['dias_termino'] = $request['cantidad_dias'];
            $nuevo_auto_admisorio['horas_termino'] = $request['cantidad_horas'];
            if ($request['cantidad_dias']) {
                $nuevo_auto_admisorio['fecha_limite'] = strtotime("+{$request['cantidad_dias']} days", strtotime($request['fecha_notificacion']));
                $nuevo_auto_admisorio['fecha_limite'] = date('Y-m-d H:i:s', $nuevo_auto_admisorio['fecha_limite']);
            } else {
                $nuevo_auto_admisorio['fecha_limite'] = strtotime("+{$request['cantidad_horas']} hour", strtotime($request['fecha_notificacion']));
                $nuevo_auto_admisorio['fecha_limite'] = date('Y-m-d H:i:s', $nuevo_auto_admisorio['fecha_limite']);
            }

            $nuevo_auto_admisorio['medida_cautelar'] = $request['medida_cautelar'];
            if ($request['medida_cautelar']) {
                $nuevo_auto_admisorio['text_medida_cautelar'] = $request['text_medida_cautelar'];
                $nuevo_auto_admisorio['dias_medida_cautelar'] = $request['dias_medida_cautelar'];
                $nuevo_auto_admisorio['horas_medida_cautelar'] = $request['horas_medida_cautelar'];
            }
            $repuesta = AutoAdmisorio::create($nuevo_auto_admisorio);
            return response()->json(['mensaje' => 'ok', 'data' => $repuesta]);
        } else {
            abort(404);
        }
    }

    public function update_auto_admisorio(Request $request)
    {
        if ($request->ajax()) {
            $documento = $request->allFiles();
            if ($request->hasFile("archivo_anexo_admisorio")) {
                $ruta = Config::get('constantes.folder_auto_admisorios');
                $ruta = trim($ruta);
                $doc_subido = $documento["archivo_anexo_admisorio"];
                $tamaño = $doc_subido->getSize();
                if ($tamaño > 0) {
                    $tamaño = $tamaño / 1000;
                }
                $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
                $nuevo_auto_admisorio['titulo_admisorio'] = $request["titulo_anexo_admisorio"];
                $nuevo_auto_admisorio['descripcion_admisorio'] = $request["descripcion_anexo_admisorio"];
                $nuevo_auto_admisorio['url_admisorio'] = $nombre_doc;
                $nuevo_auto_admisorio['extension_admisorio'] = $doc_subido->getClientOriginalExtension();
                $nuevo_auto_admisorio['peso_admisorio'] = $tamaño;
                $doc_subido->move($ruta, $nombre_doc);
            }
            if ($request->hasFile("archivo_anexo_tutela")) {
                $ruta_tutela = Config::get('constantes.folder_tutelas');
                $ruta_tutela = trim($ruta_tutela);
                $doc_subido_tutela = $documento["archivo_anexo_tutela"];
                $tamaño_tutela = $doc_subido_tutela->getSize();
                if ($tamaño_tutela > 0) {
                    $tamaño_tutela = $tamaño_tutela / 1000;
                }
                $nombre_doc_tutela = time() . '-' . utf8_encode(utf8_decode($doc_subido_tutela->getClientOriginalName()));
                $nuevo_auto_admisorio['titulo_tutela'] = $request["titulo_anexo_tutela"];
                $nuevo_auto_admisorio['descripcion_tutela'] = $request["descripcion_anexo_tutela"];
                $nuevo_auto_admisorio['url_tutela'] = $nombre_doc_tutela;
                $nuevo_auto_admisorio['extension_tutela'] = $doc_subido_tutela->getClientOriginalExtension();
                $nuevo_auto_admisorio['peso_tutela'] = $tamaño_tutela;
                $doc_subido_tutela->move($ruta_tutela, $nombre_doc_tutela);
            }
            $repuesta = AutoAdmisorio::findOrFail($request["id"])->update($nuevo_auto_admisorio);
            return response()->json(['mensaje' => 'ok', 'data' => $repuesta]);
        } else {
            abort(404);
        }
    }

    public function update_tutela(Request $request)
    {
        if ($request->ajax()) {
            $update_tutela['empleado_asignado_id'] = session('id_usuario');
            $update_tutela['fecha_radicado'] = date("Y-m-d H:i:s");
            $update_tutela['estado_creacion'] = 1;
            $update_tutela['estadostutela_id'] = 2;
            if ($request['check_cantidad_hechos'] == 'true') {
                $update_tutela['cantidad_hechos'] = 1;
            }
            if ($request['check_cantidad_pretensiones'] == 'true') {
                $update_tutela['cantidad_pretensiones'] = 1;
            }
            $repuesta = AutoAdmisorio::findOrFail($request["id"])->update($update_tutela);
            return response()->json(['mensaje' => 'ok', 'data' => $repuesta]);
        } else {
            abort(404);
        }
    }

    public function crear_accion(Request $request)
    {
        if ($request->ajax()) {
            $nuevo_accion['auto_admisorio_id'] = $request['id'];
            $nuevo_accion['tipo_accion_id'] = $request['tipo_accion'];
            $nuevo_accion['tipo_persona_id'] = $request['tipo_persona_accion'];
            $nuevo_accion['docutipos_id_accion'] = $request['docutipos_id_accion'];
            $nuevo_accion['numero_documento_accion'] = $request['numero_documento_accion'];
            $nuevo_accion['nombres_accion'] = $request['nombres_accion'];
            $nuevo_accion['apellidos_accion'] = $request['apellidos_accion'];
            $nuevo_accion['correo_accion'] = $request['correo_accion'];
            $nuevo_accion['direccion_accion'] = $request['direccion_accion'];
            $nuevo_accion['telefono_accion'] = $request['telefono_accion'];

            $nuevo_accion['nombre_apoderado'] = $request['nombre_apoderado'];
            $nuevo_accion['docutipos_id_apoderado'] = $request['docutipos_id_apoderado'];
            $nuevo_accion['numero_documento_apoderado'] = $request['numero_documento_apoderado'];
            $nuevo_accion['tarjeta_profesional_apoderado'] = $request['tarjeta_profesional_apoderado'];
            $nuevo_accion['correo_apoderado'] = $request['correo_apoderado'];
            $nuevo_accion['direccion_apoderado'] = $request['direccion_apoderado'];
            $nuevo_accion['telefono_apoderado'] = $request['telefono_apoderado'];

            $repuesta = Accions::create($nuevo_accion);
            return response()->json(['mensaje' => 'ok', 'data' => $repuesta]);
        } else {
            abort(404);
        }
    }

    public function crear_motivos_tutela(Request $request)
    {
        if ($request->ajax()) {
            $nuevo_motivo['auto_admisorio_id'] = $request['id'];
            $nuevo_motivo['motivotutelas_id'] = $request['motivo_tutela'];
            $nuevo_motivo['submotivotutelas_id'] = $request['sub_motivo_tutela'];
            $nuevo_motivo['tipo_tutela'] = $request['tipo_tutela'];
            $repuesta = MotivosTutela::create($nuevo_motivo);
            return response()->json(['mensaje' => 'ok', 'data' => $repuesta]);
        } else {
            abort(404);
        }
    }

    public function crear_anexo_tutela(Request $request)
    {
        if ($request->ajax()) {
            $documento = $request->allFiles();
            if ($request->hasFile("archivo_anexo")) {
                $ruta = Config::get('constantes.folder_tutelas');
                $ruta = trim($ruta);
                $doc_subido = $documento["archivo_anexo"];
                $tamaño = $doc_subido->getSize();
                if ($tamaño > 0) {
                    $tamaño = $tamaño / 1000;
                }
                $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
                $nuevo_anexo['titulo'] = $request["titulo"];
                $nuevo_anexo['descripcion'] = $request["descripcion"];
                $nuevo_anexo['url'] = $nombre_doc;
                $nuevo_anexo['extension'] = $doc_subido->getClientOriginalExtension();
                $nuevo_anexo['peso'] = $tamaño;
                $nuevo_anexo['auto_admisorio_id'] = $request['id'];
                $doc_subido->move($ruta, $nombre_doc);
                $repuesta = AnexoTutela::create($nuevo_anexo);
            }
            return response()->json(['mensaje' => 'ok', 'data' => $repuesta]);
        } else {
            abort(404);
        }
    }

    public function crear_hechos_tutela(Request $request)
    {
        if ($request->ajax()) {
            $nuevo_hecho['auto_admisorio_id'] = $request['auto_admisorio_id'];
            if ($request['check_cantidad_hechos'] == 'true') {
                for ($i = 0; $i < $request['cantidad_hechos']; $i++) {
                    $nuevo_hecho['hecho'] = '';
                    $nuevo_hecho['consecutivo'] = $i + 1;
                    $repuesta = HechosTutela::create($nuevo_hecho);
                }
                $repuesta = 'ok';
            } else {
                $nuevo_hecho['hecho'] = $request['hecho'];
                $nuevo_hecho['consecutivo'] = $request['consecutivo'];
                $repuesta = HechosTutela::create($nuevo_hecho);
            }
            return response()->json(['mensaje' => 'ok', 'data' => $repuesta]);
        } else {
            abort(404);
        }
    }

    public function crear_pretensiones_tutela(Request $request)
    {
        if ($request->ajax()) {
            $nuevo_pretension['auto_admisorio_id'] = $request['auto_admisorio_id'];
            if ($request['check_cantidad_pretensiones'] == 'true') {
                for ($i = 0; $i < $request['cantidad_pretensiones']; $i++) {
                    $nuevo_pretension['pretension'] = '';
                    $nuevo_pretension['consecutivo'] = $i + 1;
                    $repuesta = PretensionesTutela::create($nuevo_pretension);
                }
                $repuesta = 'ok';
            } else {
                $nuevo_pretension['pretension'] = $request['pretension'];
                $nuevo_pretension['consecutivo'] = $request['consecutivo'];
                $repuesta = PretensionesTutela::create($nuevo_pretension);
            }
            return response()->json(['mensaje' => 'ok', 'data' => $repuesta]);
        } else {
            abort(404);
        }
    }

    public function crear_argumentos_tutela(Request $request)
    {
        if ($request->ajax()) {
            $nuevo_argumento['auto_admisorio_id'] = $request['auto_admisorio_id'];
            $nuevo_argumento['argumento'] = $request['argumento'];
            $repuesta = ArgumentosTutela::create($nuevo_argumento);
            return response()->json(['mensaje' => 'ok', 'data' => $repuesta]);
        } else {
            abort(404);
        }
    }

    public function crear_pruebas_tutela(Request $request)
    {
        if ($request->ajax()) {
            $documento = $request->allFiles();
            if ($request->hasFile("archivo_anexo")) {
                $ruta = Config::get('constantes.folder_tutelas_pruebas');
                $ruta = trim($ruta);
                $doc_subido = $documento["archivo_anexo"];
                $tamaño = $doc_subido->getSize();
                if ($tamaño > 0) {
                    $tamaño = $tamaño / 1000;
                }
                $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
                $nuevo_anexo['titulo'] = $request["titulo"];
                $nuevo_anexo['descripcion'] = $request["descripcion"];
                $nuevo_anexo['url'] = $nombre_doc;
                $nuevo_anexo['extension'] = $doc_subido->getClientOriginalExtension();
                $nuevo_anexo['peso'] = $tamaño;
                $nuevo_anexo['auto_admisorio_id'] = $request['id'];
                $doc_subido->move($ruta, $nombre_doc);
                $repuesta = PruebasTutela::create($nuevo_anexo);
            }
            return response()->json(['mensaje' => 'ok', 'data' => $repuesta]);
        } else {
            abort(404);
        }
    }

    public function historial_tutela_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionHistorial['auto_admisorio_id'] = $request['idAuto'];
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['mensajeHistorial'];
            $historial = HistorialAsignacion::create($asignacionHistorial);
            return response()->json(['mensaje' => 'ok', 'data' => $historial]);
        } else {
            abort(404);
        }
    }

    public function asignacion_tutela_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionData['estado_asignacion'] = (int)$request['confirmacionAsignacion'];
            if ($asignacionData['estado_asignacion'] == 0) {
                $asignacionData['empleado_asignado_id'] = null;
                $estado = AutoAdmisorio::findOrFail($request['idAuto'])->update($asignacionData);
            } else {
                $asignacionData['estadostutela_id'] = 3;
                $estado = AutoAdmisorio::findOrFail($request['idAuto'])->update($asignacionData);
                $tareas = Tarea::all();
                $validarTareas = AsignacionTarea::where('auto_admisorio_id', $request['idAuto'])->get();
                if (!sizeOf($validarTareas)) {
                    foreach ($tareas as $value) {
                        $asignacionTarea['auto_admisorio_id'] = $request['idAuto'];
                        $asignacionTarea['empleado_id'] = session('id_usuario');
                        $asignacionTarea['tareas_id'] = $value['id'];
                        $asignacionTarea['estado_id'] = 1;
                        AsignacionTarea::create($asignacionTarea);
                    }
                }
                if ($request['reAsignacion'] === "true") {
                    $hechos =  HechosTutela::where('auto_admisorio_id', $request['idAuto'])->get();
                    foreach ($hechos as $hecho) {
                        $id = $hecho['id'];
                        $hechoActualizar['empleado_id'] = session('id_usuario');
                        HechosTutela::findOrFail($id)->update($hechoActualizar);
                    }
                    $pretensiones =  PretensionesTutela::where('auto_admisorio_id', $request['idAuto'])->get();
                    foreach ($pretensiones as $pretension) {
                        $id = $pretension['id'];
                        $pretensionActualizar['empleado_id'] = session('id_usuario');
                        PretensionesTutela::findOrFail($id)->update($pretensionActualizar);
                    }
                }
            }
            $asignacionHistorial['auto_admisorio_id'] = $request['idAuto'];
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['mensajeAsignacion'];
            $historial = HistorialAsignacion::create($asignacionHistorial);

            $respuesta['estado'] = $estado;
            $respuesta['historial'] = $historial;
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function asignacion_tarea_tutela_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionTarea['empleado_id'] = (int)$request['funcionario'];
            $tareas = AsignacionTarea::where('auto_admisorio_id', $request['idAuto'])->where('tareas_id', $request['tarea'])->get();
            foreach ($tareas as $tarea) {
                $id = $tarea->id;
            }
            $tareaActualizar = AsignacionTarea::findOrFail($id)->update($asignacionTarea);
            return response()->json(['mensaje' => 'ok', 'data' => $tareaActualizar]);
        } else {
            abort(404);
        }
    }

    public function historial_tarea_tutela_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionHistorial['auto_admisorio_id'] = $request['idAuto'];
            if ($request['idTarea']) {
                $asignacionHistorial['tareas_tutela_id'] = $request['idTarea'];
            }
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['mensajeHistorial'];
            $historial = HistorialTareas::create($asignacionHistorial);
            return response()->json(['mensaje' => 'ok', 'data' => $historial]);
        } else {
            abort(404);
        }
    }

    public function gestionar_asignacion_supervisa_tutela($id)
    {
        $estados = AsignacionEstados::all();
        $tutela = AutoAdmisorio::findorFail($id);
        $estadoPrioridad = Prioridad::all();
        return view('intranet.funcionarios.tutela.tutela_tareas.gestion_asignacion_supervisa', compact('tutela', 'estadoPrioridad', 'estados'));
    }

    public function gestionar_asignacion_proyecta_tutela($id)
    {
        $estados = AsignacionEstados::all();
        $tutela = AutoAdmisorio::findorFail($id);
        $estadoPrioridad = Prioridad::all();
        return view('intranet.funcionarios.tutela.tutela_tareas.gestion_asignacion_proyecta', compact('tutela', 'estadoPrioridad', 'estados'));
    }

    public function gestionar_asignacion_revisa_aprueba_tutela($id)
    {
        $estados = AsignacionEstados::all();
        $tutela = AutoAdmisorio::findorFail($id);
        $estadoPrioridad = Prioridad::all();
        return view('intranet.funcionarios.tutela.tutela_tareas.gestion_asignacion_revisa_aprueba', compact('tutela', 'estadoPrioridad', 'estados'));
    }

    public function gestionar_asignacion_radica_tutela($id)
    {
        $estados = AsignacionEstados::all();
        $tutela = AutoAdmisorio::findorFail($id);
        $estadoPrioridad = Prioridad::all();
        return view('intranet.funcionarios.tutela.tutela_tareas.gestion_asignacion_radica', compact('tutela', 'estadoPrioridad', 'estados'));
    }

    public function prioridad_tutela_guardar(Request $request)
    {
        if ($request->ajax()) {
            $prioridad['prioridad_id'] = (int)$request['prioridad'];
            $tutelaActualizar = AutoAdmisorio::findOrFail($request['idAuto'])->update($prioridad);
            return response()->json(['mensaje' => 'ok', 'data' => $tutelaActualizar]);
        } else {
            abort(404);
        }
    }

    public function estado_hecho_guardar(Request $request)
    {
        $nuevoEstado['estado_id'] = $request["estado"];
        if ($request['id_hecho']) {
            $hecho = HechosTutela::findOrFail($request['id_hecho'])->update($nuevoEstado);
        } else {
            foreach ($request['id_hechos'] as $hechoId) {
                HechosTutela::findOrFail($hechoId)->update($nuevoEstado);
            }
            $hecho = 'ok';
        }
        return response()->json(['mensaje' => 'ok', 'data' => $hecho]);
    }

    public function estado_pretension_guardar(Request $request)
    {
        $nuevoEstado['estado_id'] = $request["estado"];
        if ($request['id_pretension']) {
            $pretension = PretensionesTutela::findOrFail($request['id_pretension'])->update($nuevoEstado);
        } else {
            foreach ($request['id_pretensiones'] as $pretensionId) {
                PretensionesTutela::findOrFail($pretensionId)->update($nuevoEstado);
            }
            $pretension = 'ok';
        }
        return response()->json(['mensaje' => 'ok', 'data' => $pretension]);
    }

    public function estado_resuelve_guardar(Request $request)
    {
        $nuevoEstado['estado_id'] = $request["estado"];
        if ($request['id_resuelve']) {
            $resuelve = ImpugnacionInterna::findOrFail($request['id_resuelve'])->update($nuevoEstado);
        } else {
            foreach ($request['id_resuelves'] as $resuelveId) {
                ImpugnacionInterna::findOrFail($resuelveId)->update($nuevoEstado);
            }
            $resuelve = 'ok';
        }
        return response()->json(['mensaje' => 'ok', 'data' => $resuelve]);
    }

    public function asignacion_impugnacion_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionImpugnacion['empleado_id'] = (int)$request['funcionario'];
            $impugnacionActualizar = ImpugnacionInterna::findOrFail($request['impugnacion'])->update($asignacionImpugnacion);
            return response()->json(['mensaje' => 'ok', 'data' => $impugnacionActualizar]);
        } else {
            abort(404);
        }
    }

    public function asignacion_hecho_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionHecho['empleado_id'] = (int)$request['funcionario'];
            $hechoActualizar = HechosTutela::findOrFail($request['hecho'])->update($asignacionHecho);
            return response()->json(['mensaje' => 'ok', 'data' => $hechoActualizar]);
        } else {
            abort(404);
        }
    }

    public function asignacion_pretension_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionPretension['empleado_id'] = (int)$request['funcionario'];
            $pretensionActualizar = PretensionesTutela::findOrFail($request['pretension'])->update($asignacionPretension);
            return response()->json(['mensaje' => 'ok', 'data' => $pretensionActualizar]);
        } else {
            abort(404);
        }
    }

    public function asignacion_resuelve_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionResuelve['empleado_id'] = (int)$request['funcionario'];
            $resuelveActualizar = ImpugnacionInterna::findOrFail($request['resuelve'])->update($asignacionResuelve);
            return response()->json(['mensaje' => 'ok', 'data' => $resuelveActualizar]);
        } else {
            abort(404);
        }
    }

    public function historial_hecho_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionHistorial['auto_admisorio_id'] = $request['idAuto'];
            $asignacionHistorial['hechos_tutela_id'] = $request['idHecho'];
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['mensajeHistorial'];
            $historial = HistorialHecho::create($asignacionHistorial);
            return response()->json(['mensaje' => 'ok', 'data' => $historial]);
        } else {
            abort(404);
        }
    }

    public function historial_respuesta_hecho_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionHistorial['respuesta_hecho_id'] = $request['respuesta_hecho_id'];
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['historial'];
            $historial = HistorialRespuestaHecho::create($asignacionHistorial);
            return response()->json(['mensaje' => 'ok', 'data' => $historial]);
        } else {
            abort(404);
        }
    }

    public function historial_pretension_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionHistorial['auto_admisorio_id'] = $request['idAuto'];
            $asignacionHistorial['pretensiones_tutela_id'] = $request['idPretension'];
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['mensajeHistorial'];
            $historial = HistorialPretension::create($asignacionHistorial);
            return response()->json(['mensaje' => 'ok', 'data' => $historial]);
        } else {
            abort(404);
        }
    }

    public function historial_respuesta_pretension_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionHistorial['respuesta_pretension_id'] = $request['respuesta_pretension_id'];
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['historial'];
            $historial = HistorialRespuestaPretension::create($asignacionHistorial);
            return response()->json(['mensaje' => 'ok', 'data' => $historial]);
        } else {
            abort(404);
        }
    }

    public function historial_respuesta_resuelve_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionHistorial['respuesta_impugnaciones_id'] = $request['respuesta_resuelve_id'];
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['historial'];
            $historial = HistorialRespuestaImpugnacion::create($asignacionHistorial);
            return response()->json(['mensaje' => 'ok', 'data' => $historial]);
        } else {
            abort(404);
        }
    }

    public function respuesta_pretension_guardar(Request $request)
    {
        if ($request->ajax()) {
            $respuesta['auto_admisorio_id'] = $request["id_auto"];
            $respuesta['respuesta'] = $request["respuesta"];
            $respuesta['estado_id'] = $request["estado"];
            $respuesta['empleado_id'] = session('id_usuario');
            $respuesta['fecha'] = date("Y-m-d");
            $respuestaPretension = RespuestaPretensiones::create($respuesta);
            $id_respuesta = $respuestaPretension['id'];
            return response()->json(['mensaje' => 'ok', 'data' => $id_respuesta]);
        } else {
            abort(404);
        }
    }

    public function respuesta_resuelve_guardar(Request $request)
    {
        if ($request->ajax()) {
            $respuesta['sentenciapinstancia_id'] = $request["sentenciapinstancia_id"];
            $respuesta['respuesta'] = $request["respuesta"];
            $respuesta['estado_id'] = $request["estado"];
            $respuesta['empleado_id'] = session('id_usuario');
            $respuesta['fecha'] = date("Y-m-d");
            $respuestaResuelve = RespuestaImpugnaciones::create($respuesta);
            $id_respuesta = $respuestaResuelve['id'];
            return response()->json(['mensaje' => 'ok', 'data' => $id_respuesta]);
        } else {
            abort(404);
        }
    }

    public function respuesta_hecho_guardar(Request $request)
    {
        if ($request->ajax()) {
            $respuesta['auto_admisorio_id'] = $request["id_auto"];
            $respuesta['respuesta'] = $request["respuesta"];
            $respuesta['estado_id'] = $request["estado"];
            $respuesta['empleado_id'] = session('id_usuario');
            $respuesta['fecha'] = date("Y-m-d");
            $respuestaHecho = RespuestaHechos::create($respuesta);
            $id_respuesta = $respuestaHecho['id'];
            return response()->json(['mensaje' => 'ok', 'data' => $id_respuesta]);
        } else {
            abort(404);
        }
    }

    public function respuesta_pretension_editar_guardar(Request $request)
    {
        if ($request->ajax()) {
            if ($request['respuesta']) {
                $respuestaActualizada['respuesta'] = $request['respuesta'];
                $respuestaActualizada['estado_id'] = $request['estado'];
            }
            if ($request['funcionario']) {
                $respuestaActualizada['empleado_id'] = $request['funcionario'];
            }
            $respuesta = RespuestaPretensiones::findOrFail($request['id_respuesta'])->update($respuestaActualizada);
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function respuesta_resuelve_editar_guardar(Request $request)
    {
        if ($request->ajax()) {
            if ($request['respuesta']) {
                $respuestaActualizada['respuesta'] = $request['respuesta'];
                $respuestaActualizada['estado_id'] = $request['estado'];
            }
            if ($request['funcionario']) {
                $respuestaActualizada['empleado_id'] = $request['funcionario'];
            }
            $respuesta = RespuestaImpugnaciones::findOrFail($request['id_respuesta'])->update($respuestaActualizada);
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function respuesta_hecho_editar_guardar(Request $request)
    {
        if ($request->ajax()) {
            if ($request['respuesta']) {
                $respuestaActualizada['respuesta'] = $request['respuesta'];
                $respuestaActualizada['estado_id'] = $request['estado'];
            }
            if ($request['funcionario']) {
                $respuestaActualizada['empleado_id'] = $request['funcionario'];
            }
            $respuesta = RespuestaHechos::findOrFail($request['id_respuesta'])->update($respuestaActualizada);
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function respuesta_pretension_anexo_guardar(Request $request)
    {
        if ($request->ajax()) {
            $documentos = $request->allFiles();
            if ($request->hasFile('archivo')) {
                $ruta = Config::get('constantes.folder_pretensiones');
                $ruta = trim($ruta);
                $doc_subido = $documentos["archivo"];
                $tamaño = $doc_subido->getSize();
                if ($tamaño > 0) {
                    $tamaño = $tamaño / 1000;
                }
                $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
                $nuevo_documento['respuesta_pretensiones_id'] = $request["respuesta_pretensiones_id"];
                $nuevo_documento['titulo'] = $request["titulo"];
                if ($request["descripcion"]) {
                    $nuevo_documento['descripcion'] = $request["descripcion"];
                } else {
                    $nuevo_documento['descripcion'] = '';
                }
                $nuevo_documento['extension'] = $doc_subido->getClientOriginalExtension();
                $nuevo_documento['peso'] = $tamaño;
                $nuevo_documento['url'] = $nombre_doc;
                $doc_subido->move($ruta, $nombre_doc);
                $respuesta = DocRespuestaPretension::create($nuevo_documento);
            }

            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function respuesta_resuelve_anexo_guardar(Request $request)
    {
        if ($request->ajax()) {
            $documentos = $request->allFiles();
            if ($request->hasFile('archivo')) {
                $ruta = Config::get('constantes.folder_sentencias_resuelves');
                $ruta = trim($ruta);
                $doc_subido = $documentos["archivo"];
                $tamaño = $doc_subido->getSize();
                if ($tamaño > 0) {
                    $tamaño = $tamaño / 1000;
                }
                $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
                $nuevo_documento['respuesta_impugnaciones_id'] = $request["respuesta_resuelves_id"];
                $nuevo_documento['titulo'] = $request["titulo"];
                if ($request["descripcion"]) {
                    $nuevo_documento['descripcion'] = $request["descripcion"];
                } else {
                    $nuevo_documento['descripcion'] = '';
                }
                $nuevo_documento['extension'] = $doc_subido->getClientOriginalExtension();
                $nuevo_documento['peso'] = $tamaño;
                $nuevo_documento['url'] = $nombre_doc;
                $doc_subido->move($ruta, $nombre_doc);
                $respuesta = DocRespuestaImpugnacion::create($nuevo_documento);
            }

            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function respuesta_hecho_anexo_guardar(Request $request)
    {
        if ($request->ajax()) {
            $documentos = $request->allFiles();
            if ($request->hasFile('archivo')) {
                $ruta = Config::get('constantes.folder_hechos');
                $ruta = trim($ruta);
                $doc_subido = $documentos["archivo"];
                $tamaño = $doc_subido->getSize();
                if ($tamaño > 0) {
                    $tamaño = $tamaño / 1000;
                }
                $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
                $nuevo_documento['respuesta_hechos_id'] = $request["respuesta_hechos_id"];
                $nuevo_documento['titulo'] = $request["titulo"];
                if ($request["descripcion"]) {
                    $nuevo_documento['descripcion'] = $request["descripcion"];
                } else {
                    $nuevo_documento['descripcion'] = '';
                }
                $nuevo_documento['extension'] = $doc_subido->getClientOriginalExtension();
                $nuevo_documento['peso'] = $tamaño;
                $nuevo_documento['url'] = $nombre_doc;
                $doc_subido->move($ruta, $nombre_doc);
                $respuesta = DocRespuestaHecho::create($nuevo_documento);
            }

            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function relacion_respuesta_hecho_guardar(Request $request)
    {
        $relacion['auto_admisorio_id'] = $request["id_auto"];
        $relacion['respuesta_hechos_id'] = $request["id_respuesta"];
        if ($request["id_hecho"]) {
            $relacion['hecho_tutela_id'] = $request["id_hecho"];
            $respuestaRelacion = RelacionHecho::create($relacion);
        } else {
            foreach ($request["id_hechos"] as $hechoId) {
                $relacion['hecho_tutela_id'] = $hechoId;
                RelacionHecho::create($relacion);
            }
            $respuestaRelacion = 'ok';
        }
        return response()->json(['mensaje' => 'ok', 'data' => $respuestaRelacion]);
    }

    public function estado_respuesta_hecho_guardar(Request $request)
    {
        if ($request->ajax()) {
            $hechos = RelacionHecho::where('respuesta_hechos_id', $request["id_respuesta"])->get();
            foreach ($hechos as $hecho) {
                $nuevoEstado['estado_id'] = $request["estado"];
                $respuesta = HechosTutela::findOrFail($hecho['hecho_tutela_id'])->update($nuevoEstado);
            }
            $nuevoEstado['estado_id'] = $request["estado"];
            $respuesta = RespuestaHechos::findOrFail($request['id_respuesta'])->update($nuevoEstado);
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function eliminar_respuesta_hecho_guardar(Request $request)
    {
        if ($request->ajax()) {
            $relacionHecho = RelacionHecho::where('hecho_tutela_id', $request["hecho_id"])->get();
            $relacionHecho = $relacionHecho[0];
            $respuestaHechos = RespuestaHechos::findOrFail($relacionHecho['respuesta_hechos_id']);
            if (sizeOf($respuestaHechos->relacion) == 1) {
                RelacionHecho::where('hecho_tutela_id', $request["hecho_id"])->delete();
                $anexos = DocRespuestaHecho::where('respuesta_hechos_id', $respuestaHechos['id'])->get();
                if (sizeOf($anexos)) {
                    foreach ($anexos as $anexo) {
                        DocRespuestaHecho::where('respuesta_hechos_id', $anexo['id'])->delete();
                    }
                }
                $historiales = HistorialRespuestaHecho::where('respuesta_hecho_id', $respuestaHechos['id'])->get();
                if (sizeOf($historiales)) {
                    foreach ($historiales as $historial) {
                        HistorialRespuestaHecho::where('respuesta_hecho_id', $historial['id'])->delete();
                    }
                }
                RespuestaHechos::findOrFail($relacionHecho['respuesta_hechos_id'])->delete();
                $nuevoEstado['estado_id'] = 1;
                HechosTutela::findOrFail($relacionHecho['hecho_tutela_id'])->update($nuevoEstado);
            } else {
                RelacionHecho::where('hecho_tutela_id', $request["hecho_id"])->delete();
                $nuevoEstado['estado_id'] = 1;
                HechosTutela::findOrFail($relacionHecho['hecho_tutela_id'])->update($nuevoEstado);
            }
            return response()->json(['mensaje' => 'ok', 'data' => 'ok']);
        } else {
            abort(404);
        }
    }

    public function relacion_respuesta_pretension_guardar(Request $request)
    {
        $relacion['auto_admisorio_id'] = $request["id_auto"];
        $relacion['respuesta_pretensiones_id'] = $request["id_respuesta"];
        if ($request["id_pretension"]) {
            $relacion['pretension_tutela_id'] = $request["id_pretension"];
            $respuestaRelacion = RelacionPretension::create($relacion);
        } else {
            foreach ($request["id_pretensiones"] as $pretensionId) {
                $relacion['pretension_tutela_id'] = $pretensionId;
                RelacionPretension::create($relacion);
            }
            $respuestaRelacion = 'ok';
        }
        return response()->json(['mensaje' => 'ok', 'data' => $respuestaRelacion]);
    }

    public function relacion_respuesta_resuelve_guardar(Request $request)
    {
        $relacion['sentenciapinstancia_id'] = $request["sentenciapinstancia_id"];
        $relacion['respuesta_impugnaciones_id'] = $request["id_respuesta"];
        if ($request["id_resuelve"]) {
            $relacion['impugnacion_interna_id'] = $request["id_resuelve"];
            $respuestaRelacion = RelacionesImpugnacion::create($relacion);
        } else {
            foreach ($request["id_resuelves"] as $resuelveId) {
                $relacion['impugnacion_interna_id'] = $resuelveId;
                RelacionesImpugnacion::create($relacion);
            }
            $respuestaRelacion = 'ok';
        }
        return response()->json(['mensaje' => 'ok', 'data' => $respuestaRelacion]);
    }

    public function estado_respuesta_pretension_guardar(Request $request)
    {
        if ($request->ajax()) {
            $pretensiones = RelacionPretension::where('respuesta_pretensiones_id', $request["id_respuesta"])->get();
            foreach ($pretensiones as $pretension) {
                $nuevoEstado['estado_id'] = $request["estado"];
                PretensionesTutela::findOrFail($pretension['pretension_tutela_id'])->update($nuevoEstado);
            }
            $nuevoEstado['estado_id'] = $request["estado"];
            $respuesta = RespuestaPretensiones::findOrFail($request['id_respuesta'])->update($nuevoEstado);
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function estado_respuesta_resuelve_guardar(Request $request)
    {
        if ($request->ajax()) {
            $resuelves = RelacionesImpugnacion::where('respuesta_impugnaciones_id', $request["id_respuesta"])->get();
            foreach ($resuelves as $resuelves) {
                $nuevoEstado['estado_id'] = $request["estado"];
                ImpugnacionInterna::findOrFail($resuelves['impugnacion_interna_id'])->update($nuevoEstado);
            }
            $nuevoEstado['estado_id'] = $request["estado"];
            $respuesta = RespuestaImpugnaciones::findOrFail($request['id_respuesta'])->update($nuevoEstado);
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function eliminar_respuesta_pretension_guardar(Request $request)
    {
        if ($request->ajax()) {
            $relacionPretension = RelacionPretension::where('pretension_tutela_id', $request["pretension_id"])->get();
            $relacionPretension = $relacionPretension[0];
            $respuestaPretensiones = RespuestaPretensiones::findOrFail($relacionPretension['respuesta_pretensiones_id']);
            if (sizeOf($respuestaPretensiones->relacion) == 1) {
                RelacionPretension::where('pretension_tutela_id', $request["pretension_id"])->delete();
                $anexos = DocRespuestaPretension::where('respuesta_pretensiones_id', $respuestaPretensiones['id'])->get();
                if (sizeOf($anexos)) {
                    foreach ($anexos as $anexo) {
                        DocRespuestaPretension::where('respuesta_pretensiones_id', $anexo['id'])->delete();
                    }
                }
                $historiales = HistorialRespuestaPretension::where('respuesta_pretension_id', $respuestaPretensiones['id'])->get();
                if (sizeOf($historiales)) {
                    foreach ($historiales as $historial) {
                        HistorialRespuestaPretension::where('respuesta_pretension_id', $historial['id'])->delete();
                    }
                }
                RespuestaPretensiones::findOrFail($relacionPretension['respuesta_pretensiones_id'])->delete();
                $nuevoEstado['estado_id'] = 1;
                PretensionesTutela::findOrFail($relacionPretension['pretension_tutela_id'])->update($nuevoEstado);
            } else {
                RelacionPretension::where('pretension_tutela_id', $request["pretension_id"])->delete();
                $nuevoEstado['estado_id'] = 1;
                PretensionesTutela::findOrFail($relacionPretension['pretension_tutela_id'])->update($nuevoEstado);
            }
            return response()->json(['mensaje' => 'ok', 'data' => 'ok']);
        } else {
            abort(404);
        }
    }

    public function eliminar_respuesta_resuelve_guardar(Request $request)
    {
        if ($request->ajax()) {
            $relacionResuelve = RelacionesImpugnacion::where('impugnacion_interna_id', $request["resuelve_id"])->get();
            $relacionResuelve = $relacionResuelve[0];
            $respuestaResuelves = RespuestaImpugnaciones::findOrFail($relacionResuelve['respuesta_impugnaciones_id']);
            if (sizeOf($respuestaResuelves->relacion) == 1) {
                RelacionesImpugnacion::where('impugnacion_interna_id', $request["resuelve_id"])->delete();
                $anexos = DocRespuestaImpugnacion::where('respuesta_impugnaciones_id', $respuestaResuelves['id'])->get();
                if (sizeOf($anexos)) {
                    foreach ($anexos as $anexo) {
                        DocRespuestaImpugnacion::where('respuesta_impugnaciones_id', $anexo['id'])->delete();
                    }
                }
                $historiales = HistorialRespuestaImpugnacion::where('respuesta_impugnaciones_id', $respuestaResuelves['id'])->get();
                if (sizeOf($historiales)) {
                    foreach ($historiales as $historial) {
                        HistorialRespuestaImpugnacion::where('respuesta_impugnaciones_id', $historial['id'])->delete();
                    }
                }
                RespuestaImpugnaciones::findOrFail($relacionResuelve['respuesta_impugnaciones_id'])->delete();
                $nuevoEstado['estado_id'] = 1;
                ImpugnacionInterna::findOrFail($relacionResuelve['impugnacion_interna_id'])->update($nuevoEstado);
            } else {
                RelacionesImpugnacion::where('impugnacion_interna_id', $request["resuelve_id"])->delete();
                $nuevoEstado['estado_id'] = 1;
                ImpugnacionInterna::findOrFail($relacionResuelve['impugnacion_interna_id'])->update($nuevoEstado);
            }
            return response()->json(['mensaje' => 'ok', 'data' => 'ok']);
        } else {
            abort(404);
        }
    }

    public function respuesta_tutela($id)
    {
        $tutela = AutoAdmisorio::findOrFail($id);
        $resuelves = ResuelveTutela::where('auto_admisorio_id', $id)->orderBy('orden')->get();
        $imagen = public_path('imagenes\sistema\icono_sistema.png');
        $firma  = '';
        return view('intranet.funcionarios.tutela.tutela_tareas.respuesta_tutela', compact('tutela', 'imagen', 'resuelves', 'firma'));
    }

    public function respuesta_sentencia_primera_instancia($id)
    {
        $tutela = AutoAdmisorio::findOrFail($id);
        $imagen = public_path('imagenes\sistema\icono_sistema.png');
        $firma  = '';
        return view('intranet.funcionarios.tutela.tutela_tareas.respuesta_sentencia_primera_instancia', compact('tutela', 'imagen', 'firma',));
    }

    public function descarga_respuesta_tutela($id)
    {
        $respuesta = TutelaRespuesta::findOrFail($id);
        $tutela = $respuesta->tutela;
        $pdf = PDF::loadHTML($respuesta->respuesta);
        return $pdf->download('Respuesta-' . $tutela->radicado . '.pdf');
    }

    public function tutela_respuesta_guardar(Request $request)
    {
        if ($request->ajax()) {
            if ($request["idTarea"] == 4) {
                $tutela = AutoAdmisorio::findOrFail($request["idAuto"]);
                $tipo_respuesta = $request["tipo_respuesta"];
                $imagen = public_path('imagenes\sistema\logo_mgl.png');
                $firma = public_path('documentos\usuarios\\' . $tutela->empleadoasignado->url);
                //$imagen = asset('imagenes/sistema/logo_mgl.png'); //url_servidor
                //$firma = asset('documentos/usuarios/' . $tutela->empleado->url); //url_servidor
                if ($tipo_respuesta == 1) {
                    $valor = "si";
                    $resuelves = ResuelveTutela::where('auto_admisorio_id', $request["idAuto"])->orderBy('orden')->get();
                    $rPdf['respuesta'] = view('intranet.funcionarios.tutela.tutela_tareas.respuesta_tutela', compact('tutela', 'imagen', 'resuelves', 'firma'));
                } else {
                    $valor = "no";
                    $rPdf['respuesta'] = view('intranet.funcionarios.tutela.tutela_tareas.respuesta_sentencia_primera_instancia', compact('tutela', 'imagen', 'firma'));
                }
                $rPdf['auto_admisorio_id'] = $request["idAuto"];
                $rPdf['tipo_respuesta'] = $request["tipo_respuesta"];
                $rPdf['tareas_id'] = $request["idTarea"];
                $rPdf['empleado_id'] = session('id_usuario');
                $rrr = TutelaRespuesta::create($rPdf);
            }
            $tutela = AutoAdmisorio::findOrfail($request["idAuto"]);
            // $pqr_id = $pqr->id;
            // if ($pqr->persona_id != null) {
            //     $email = $pqr->persona->email;
            // }elseif($pqr->empresa_id != null){
            //     $email = $pqr->empresa->email;
            // }
            // if($request["idTarea"] == 4 && $request["apruebaRadica"] ){
            // if($email){
            //     Mail::to($email)->send(new RespuestaPQR($pqr_id));
            // }
            // }
            if (($request["idTarea"] == 4 && $request["apruebaRadica"]) || $request["idTarea"] == 5) {
                if ($tipo_respuesta == 1) {
                    $tutelaEstado['estadostutela_id'] = 4;
                } else {
                    $tutelaEstado['estadostutela_id'] = 7;
                }
                AutoAdmisorio::findOrFail($tutela->id)->update($tutelaEstado);
            }
            return response()->json(['mensaje' => 'ok', 'data' =>  $request["tipo_respuesta"]]);
        } else {
            abort(404);
        }
    }

    public function cambiar_estado_tareas_tutela_guardar(Request $request)
    {
        if ($request->ajax()) {
            if ($request['estado']) {
                $estado['estado_id'] = $request['estado'];
                $tarea = $request['idTarea'] - 1;
            } else {
                $estado['estado_id'] = 11;
                $tarea = $request['idTarea'];
            }
            $respuesta = AsignacionTarea::where('auto_admisorio_id', $request['idAuto'])->where('tareas_id', $tarea)->update($estado);
            if ($request['idTarea'] == 5) {
                AsignacionTarea::where('auto_admisorio_id', $request['idAuto'])->where('tareas_id', 1)->update($estado);
            }
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }


    public function historial_resuelve_tutela_guardar(Request $request)
    {
        if ($request->ajax()) {
            $resuelves = ResuelveTutela::where('auto_admisorio_id', $request['idAuto'])->get();
            $resuelve['orden'] = $resuelves->count() + 1;
            $resuelve['auto_admisorio_id'] = $request['idAuto'];
            $resuelve['empleado_id'] = session('id_usuario');
            $resuelve['resuelve'] = $request['mensajeResuelve'];
            $respuesta = ResuelveTutela::create($resuelve);
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function historial_resuelve_tutela_eliminar(Request $request)
    {
        if ($request->ajax()) {
            $resuelve = ResuelveTutela::findOrFail($request['value']);
            $index = $resuelve['orden'];
            $tutela = $resuelve->auto_admisorio_id;
            $respuesta = $resuelve->delete();
            $resuelves = ResuelveTutela::where('auto_admisorio_id', $tutela)->get();
            foreach ($resuelves as $key => $resuel) {
                if ($index < $resuel['orden']) {
                    $orden['orden'] =  $resuel['orden'] - 1;
                    ResuelveTutela::findOrFail($resuel->id)->update($orden);
                }
            }
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function resuelve_orden_tutela_guardar(Request $request)
    {
        if ($request->ajax()) {
            $resuelve['orden'] = $request['orden'];
            $respuesta = ResuelveTutela::findOrFail($request['id'])->update($resuelve);
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function historial_resuelve_tutela_editar(Request $request)
    {
        if ($request->ajax()) {
            $resuelve['resuelve'] = $request['resuelveNuevo'];
            $respuesta = ResuelveTutela::findOrFail($request['value'])->update($resuelve);
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function cargar_nombre_despachos(Request $request)
    {
        if ($request->ajax()) {
            $id = $_GET['id'];
            return Despachos::where('jurisdiccion', $id)->get();
        }
    }

    public function cargar_ubicacion_despachos(Request $request)
    {
        if ($request->ajax()) {
            $id = $_GET['id'];
            return Despachos::findOrfail($id);
        }
    }

    public function vista_tutela($id)
    {
        $tutela = AutoAdmisorio::findOrfail($id);
        return view('intranet.funcionarios.tutela.vista', compact('tutela'));
    }

    public function cambiosentidoresuelve(Request $request, $id)
    {
        if ($request->ajax()) {
            $sentidoResuelve['sentido'] = $request['sentido'];
            $sentidoResuelve['gestion'] = '0';
            ResuelvePrimeraInstancia::findOrFail($id)->update($sentidoResuelve);
            ImpugnacionInterna::where('resuelvesentencia_id', $id)->delete();
            $resuelvepi = ResuelvePrimeraInstancia::findOrFail($id);

            $tutela = AutoAdmisorio::findOrfail($resuelvepi->sentencia->id)
                ->with('primeraInstancia')
                ->with('primeraInstancia.impugnacionesinternas')
                ->with('primeraInstancia.impugnacionesinternas.empleado')
                ->with('primeraInstancia.impugnacionesinternas.estado')
                ->get();
            return response()->json(['mensaje' => 'ok', 'tutela' => $tutela]);
        } else {
            abort(404);
        }
    }
    public function crearimpugnacion(Request $request, $id)
    {
        if ($request->ajax()) {
            $resuelvePI = ResuelvePrimeraInstancia::findOrFail($id);
            if ($request['check'] == '1') {
                $impugnacionNew['sentenciapinstancia_id'] = $resuelvePI->sentencia->id;
                $impugnacionNew['resuelvesentencia_id'] = $id;
                $impugnacionNew['empleado_id'] = $resuelvePI->sentencia->tutela->empleado_asignado_id;
                $impugnacionNew['consecutivo'] = $resuelvePI->numeracion;
                ImpugnacionInterna::create($impugnacionNew);
                $data = 'Se activo el proceso de impugnación';
            } else {
                ImpugnacionInterna::where('resuelvesentencia_id', $id)->delete();
                $data = 'Se desactivo el proceso de impugnación';
            }
            $sentidoResuelve['gestion'] = $request['check'];
            ResuelvePrimeraInstancia::findOrFail($id)->update($sentidoResuelve);

            $tutela = AutoAdmisorio::findOrfail($resuelvePI->sentencia->id)
                ->with('primeraInstancia')
                ->with('primeraInstancia.impugnacionesinternas')
                ->with('primeraInstancia.impugnacionesinternas.empleado')
                ->with('primeraInstancia.impugnacionesinternas.estado')
                ->get();
            return response()->json(['mensaje' => 'ok', 'data' => $data, 'tutela' => $tutela]);
        } else {
            abort(404);
        }
    }

    public function verificar_sentencia_primera_instancia(Request $request, $id)
    {
        if ($request->ajax()) {
            $sentenciaPrimeraInstancia = PrimeraInstancia::findOrFail($id);
            $updateSentencia1eraInst['verificada'] = 1;
            if ($sentenciaPrimeraInstancia->impugnacionesinternas->count() > 0) {
                $updateTutela['estadostutela_id'] = 6;
            } else {
                $updateTutela['estadostutela_id'] = 5;
            }
            $sentenciaPrimeraInstancia->update($updateSentencia1eraInst);
            $tutela = AutoAdmisorio::findOrFail($id);
            $tutela->update($updateTutela);
            return response()->json(['mensaje' => 'ok']);
        } else {
            abort(404);
        }
    }
}
