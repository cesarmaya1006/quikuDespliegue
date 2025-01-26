@extends('theme.back.plantilla')
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- Pagina CSS -->
@section('estilosHojas')
    <link rel="stylesheet" href="{{ asset('css/intranet/index.css') }}">
@endsection
<!-- ************************************************************* -->
@section('tituloHoja')
    {{-- Sistema de informaci&oacute;n PQR LEGAL PROCEEDINGS --}}
@endsection
<!-- ************************************************************* -->
@section('cuerpo_pagina')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8">
                @include('includes.error-form')
                @include('includes.mensaje')
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            {{-- Inicio complemento tutela --}}
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Complemento de tutela {{ $id }}</h3>
                    </div>
                    <div class="form_auto_admisorio_complemento">
                        <div class="card-body m-2">
                            <div class="row d-flex ">
                                <div class="card card-outline card-primary collapsed-card mx-1 py-2 mb-4"
                                    style="font-size: 0.8em;">
                                    <div class="card-header">
                                        <h6 class="card-title font-weight-bold">Hechos</h6>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body" style="display: none;">
                                        <div class="form-check text-end pr-4 flex align-self-center">
                                            <label class="form-check-label mr-2"><strong>Agregar hechos por
                                                    cantidad</strong></label>
                                            <input type="checkbox" class="form-check-input check-input-hechos mt-1 mx-auto">
                                        </div>
                                        <div class="form-row none-hechos">
                                            <div class="col-12 d-flex row hechos">
                                                <div class="col-12 bloque_hecho">
                                                    <div class="col-12 d-flex row contenido_hecho">
                                                        <div class="title-hecho d-flex justify-content-between mt-2">
                                                            <label class="requerido h6">Hecho</label>
                                                            <button type="button"
                                                                class="btn btn-danger btn-xs btn-sombra pl-2 pr-2 eliminar_contenido_hechos"><i
                                                                    class="fas fa-minus-circle eliminar_contenido_hechos"></i></button>
                                                        </div>
                                                        <input class="form-control mt-2 hecho" type="text" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end flex-row mt-3">
                                                <button class="btn btn-secondary btn-xs btn-sombra pl-2 pr-2 crearHecho"><i
                                                        class="fa fa-plus-circle mr-2" aria-hidden="true"></i> Añadir otro
                                                    hecho</button>
                                            </div>
                                        </div>
                                        <div class="form-row active-hechos d-none">
                                            <div class="col-12 d-flex row hechos">
                                                <div class="row">
                                                    <label class="requerido text-black h6">Ingrese cantidad de
                                                        hechos</label>
                                                    <input class="form-control col-4 ml-2 cantidad-hechos" type="number"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary collapsed-card mx-1 py-2 mb-4"
                                    style="font-size: 0.8em;">
                                    <div class="card-header">
                                        <h6 class="card-title font-weight-bold">Pretensiones</h6>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body" style="display: none;">
                                        <div class="form-check text-end pr-4 flex align-self-center">
                                            <label class="form-check-label mr-2"><strong>Agregar pretensiones por
                                                    cantidad</strong></label>
                                            <input type="checkbox"
                                                class="form-check-input check-input-pretensiones mt-1 mx-auto">
                                        </div>
                                        <div class="form-row none-pretensiones">
                                            <div class="col-12 d-flex row pretensiones">
                                                <div class="col-12 bloque_pretension">
                                                    <div class="col-12 d-flex row contenido_pretension">
                                                        <div class="title-pretension d-flex justify-content-between mt-2">
                                                            <label class="requerido h6">Pretensión</label>
                                                            <button type="button"
                                                                class="btn btn-danger btn-xs btn-sombra pl-2 pr-2 eliminar_contenido_pretensiones"><i
                                                                    class="fas fa-minus-circle eliminar_contenido_pretensiones"></i></button>
                                                        </div>
                                                        <input class="form-control mt-2 pretension" type="text" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end flex-row mt-3">
                                                <button
                                                    class="btn btn-secondary btn-xs btn-sombra pl-2 pr-2 crearPretension"><i
                                                        class="fa fa-plus-circle mr-2" aria-hidden="true"></i> Añadir otra
                                                    pretensión</button>
                                            </div>
                                        </div>
                                        <div class="form-row active-pretensiones d-none">
                                            <div class="col-12 d-flex row pretensiones">
                                                <div class="row">
                                                    <label class="requerido text-black h6">Ingrese cantidad de
                                                        pretensiones</label>
                                                    <input class="form-control col-4 ml-2 cantidad-pretensiones"
                                                        type="number" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary collapsed-card mx-1 py-2 mb-4"
                                    style="font-size: 0.8em;">
                                    <div class="card-header">
                                        <h6 class="card-title font-weight-bold">Argumentos</h6>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body" style="display: none;">
                                        <div class="form-row">
                                            <div class="col-12 d-flex row argumentos">
                                                <div class="col-12 bloque_argumento">
                                                    <div class="col-12 d-flex row contenido_argumento">
                                                        <div class="title-argumento d-flex justify-content-between mt-2">
                                                            <label class="h6">Argumento</label>
                                                            <button type="button"
                                                                class="btn btn-danger btn-xs btn-sombra pl-2 pr-2 eliminar_contenido_argumentos"><i
                                                                    class="fas fa-minus-circle eliminar_contenido_argumentos"></i></button>
                                                        </div>
                                                        <input class="form-control mt-2 argumento" type="text" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end flex-row mt-3">
                                                <button
                                                    class="btn btn-secondary btn-xs btn-sombra pl-2 pr-2 crearArgumento"><i
                                                        class="fa fa-plus-circle mr-2" aria-hidden="true"></i> Añadir otra
                                                    argumento</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary collapsed-card mx-1 py-2"
                                    style="font-size: 0.8em;">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Pruebas</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body" style="display: none;">
                                        <div class="form-row">
                                            <div class="col-12 d-flex row anexos">
                                                <div class="col-12 bloque_anexos">
                                                    <div class="col-12 d-flex row contenido_anexo">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <label class="h6">Prueba</label>
                                                            <button type="button"
                                                                class="btn btn-danger btn-xs btn-sombra pl-2 pr-2 eliminar_contenido_anexo"><i
                                                                    class="fas fa-minus-circle"></i></button>
                                                        </div>
                                                        <div class="col-12 col-md-4 form-group titulo-anexo">
                                                            <label for="titulo">Título archivo</label>
                                                            <input type="text" class="form-control form-control-sm">
                                                        </div>
                                                        <div class="col-12 col-md-4 form-group descripcion-anexo">
                                                            <label for="descripcion">Descripción archivo</label>
                                                            <input type="text" class="form-control form-control-sm">
                                                        </div>
                                                        <div class="col-12 col-md-4 form-group anexo">
                                                            <label for="documentos">Archivo</label>
                                                            <input class="form-control form-control-sm" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end flex-row mb-3">
                                                <button class="btn btn-success btn-xs btn-sombra pl-2 pr-2 crearAnexo"><i
                                                        class="fa fa-plus-circle mr-2 crearAnexo" aria-hidden="true"></i>
                                                    Añadir otro anexo</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary collapsed-card mx-1 py-2"
                                    style="font-size: 0.8em;">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Tutela - Motivos</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body" style="display: none;">
                                        <div class="form-row">
                                            <div class="col-12 d-flex row motivos">
                                                <div class="col-12 bloque_motivos">
                                                    <div class="col-12 d-flex row contenido_motivo">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <h6></h6>
                                                            <button type="button"
                                                                class="btn btn-danger btn-xs btn-sombra pl-2 pr-2 eliminar_contenido_motivo"><i
                                                                    class="fas fa-minus-circle"></i></button>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <div class="col-12 d-flex justify-content-between">
                                                                <label class="h6 requerido" for="">Motivo</label>
                                                            </div>
                                                            <select class="custom-select rounded-0 motivo_tutela">
                                                                @foreach ($motivos as $motivo)
                                                                    @if ($motivo->sub_motivostutelas->count() > 0)
                                                                        @if ($motivo->id == 1)
                                                                            @php
                                                                                $motivotutelas_id = $motivo->id;
                                                                            @endphp
                                                                            <option value="{{ $motivo->id }}" selected>
                                                                                {{ $motivo->motivo }}</option>
                                                                        @else
                                                                            <option value="{{ $motivo->id }}">
                                                                                {{ $motivo->motivo }}</option>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label class="requerido" for="motivo_sub_tutela">Sub -
                                                                Motivo</label>
                                                            <select class="custom-select rounded-0 motivo_sub_tutela h6">
                                                                @foreach ($motivos as $motivo)
                                                                    @if ($motivo->id == 1)
                                                                        @foreach ($motivo->sub_motivostutelas as $sub_motivostutela)
                                                                            <option value="{{ $sub_motivostutela->id }}">
                                                                                {{ $sub_motivostutela->sub_motivo }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-6 form-group">
                                                            <label class="requerido" for="tipo_tutela">¿Su Tutela es
                                                                sobre un producto o servicio?</label>
                                                            <select class="custom-select rounded-0 tipo_tutela h6">
                                                                <option value="">--Seleccione--</option>
                                                                <option value="Producto">Producto</option>
                                                                <option value="Servicio">Servicio</option>
                                                            </select>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end flex-row mb-3">
                                                <button class="btn btn-success btn-xs btn-sombra pl-2 pr-2 crearMotivo"><i
                                                        class="fa fa-plus-circle mr-2 crearMotivo" aria-hidden="true"></i>
                                                    Añadir otro Motivo</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 mb-3 pl-4 d-flex justify-content-end">
                                <input class="auto_admisorio_id" type="hidden" value="{{ $id }}">
                                <button type="button" class="btn btn-primary pl-5 pr-5 btn-complemento-tutela"
                                    data_url="{{ route('crear_hechos_tutela') }}"
                                    data_url1="{{ route('crear_pretensiones_tutela') }}"
                                    data_url2="{{ route('crear_argumentos_tutela') }}"
                                    data_url3="{{ route('crear_pruebas_tutela') }}"
                                    data_url4="{{ route('crear_motivos_tutela') }}"
                                    data_url5="{{ route('update_tutela') }}"
                                    data_token="{{ csrf_token() }}">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fin complemento tutela --}}
        </div>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/tutela/complemento_tutela.js') }}"></script>
@endsection
<!-- ************************************************************* -->
