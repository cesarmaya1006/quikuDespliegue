@extends("theme.back.plantilla")
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
    Parametros - Referencias
@endsection
<!-- ************************************************************* -->
@section('cuerpo_pagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h5>listado de Referencias</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('admin-referencia-crear') }}" class="btn btn-success btn-sm text-center pl-3 pr-3"
                        style="font-size: 0.9em;"><i class="fas fa-plus-circle mr-2"></i> Nueva Referencia</a>
                </div>
            </div>
            <hr>
            <div class="row  d-flex justify-content-around">
                <div class="col-10 col-md-7 table-responsive">
                    <table class="table table-striped table-hover table-sm tabla-data display">
                        <thead class="thead-inverse">
                            <tr>
                                <th class="text-center">Categoría</th>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Marca</th>
                                <th class="text-center">Referencia</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($referencias as $referencia)
                                <tr>
                                    <td class="text-center">{{ $referencia->marca->producto->categoria->categoria }}</td>
                                    <td class="text-center">{{ $referencia->marca->producto->producto }}</td>
                                    <td class="text-center">{{ $referencia->marca->marca }}</td>
                                    <td class="text-center">{{ $referencia->referencia }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin-referencia-editar', ['id' => $referencia->id]) }}"
                                            class="btn-accion-tabla tooltipsC text-info"> <i class="fa fa-edit"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')

@endsection
<!-- ************************************************************* -->
