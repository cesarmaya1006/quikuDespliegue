@extends('theme.back.plantilla')
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/usuario.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Usuarios
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    @include('includes.mensaje')
    @include('includes.error-form')
    <div class="cuerpo">
        <div class="box">
            <div class="box-header with-border">
                <div class="row w-100">
                    <div class="col-12 col-md-6">
                        <h3 class="box-title">Listado de Usuarios</h3>
                    </div>
                    <div class="col-12 col-md-6">
                        <a href="{{ route('admin-usuario-crear') }}"
                            class="btn btn-info btn-xs pl-4 pr-4 btn-sombra float-right">
                            <i class="fa fa-fw fa-plus-circle"></i> Nuevo registro
                        </a>
                    </div>
                </div>
            </div>
            <br>
            <div class="box-body  card-primary">
                @if (session('rol_id') <= 3)
                    @php
                        $roles_ = $roles;
                    @endphp
                @else
                    @php
                        $roles_ = $roles->where('id', '>', 2);
                    @endphp
                @endif
                @foreach ($roles_ as $rol)
                    @if ($rol->usuarios->count())
                        <div class="row d-flex justify-content-around">
                            <div class="col-12 mt-3 mb-2">
                                <h3>{{ $rol->nombre }}</h3>
                            </div>
                            <div class="col-12 col-md-11 table-responsive">
                                <table class="table table-striped table-bordered table-hover display">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center" scope="col">Id {{ $rol->id }}</th>
                                            @if (session('rol_id') < 4)
                                                <th class="text-center" scope="col">Usuario</th>
                                            @endif
                                            <th class="text-center" scope="col">N. Identificacion</th>
                                            <th class="text-center" scope="col">Nombres y Apellidos</th>
                                            <th class="text-center" scope="col">Email</th>
                                            <th class="text-center" scope="col">Telefono</th>
                                            <th class="text-center" scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cuerpo_tabla_usuarios2">
                                        @foreach ($rol->usuarios as $usuario)
                                            <tr>
                                                <td class="text-center">{{ $usuario->id }}</td>
                                                @if (session('rol_id') < 4)
                                                    <td>{{$usuario->usuario}}</td>
                                                @endif
                                                <td class="text-center">
                                                    {{ $rol->id > 4 ? ($rol->id == 5 ? $usuario->empleado->tipos_docu->abreb_id . ' ' . $usuario->empleado->identificacion : $usuario->persona->tipos_docu->abreb_id . ' ' . $usuario->persona->identificacion) : '---' }}
                                                </td>
                                                <td>
                                                    {{ $rol->id > 4
                                                        ? ($rol->id == 5
                                                            ? $usuario->empleado->nombre1 .
                                                                ' ' .
                                                                $usuario->empleado->nombre2 .
                                                                ' ' .
                                                                $usuario->empleado->apellido1 .
                                                                ' ' .
                                                                $usuario->empleado->apellido2
                                                            : $usuario->persona->nombre1 .
                                                                ' ' .
                                                                $usuario->persona->nombre2 .
                                                                ' ' .
                                                                $usuario->persona->apellido1 .
                                                                ' ' .
                                                                $usuario->persona->apellido2)
                                                        : '---' }}
                                                    {{ $usuario->nombres . ' ' . $usuario->apellidos }}</td>
                                                <td>{{ $rol->id > 4 ? ($rol->id == 5 ? $usuario->empleado->email : $usuario->persona->email) : '---' }}
                                                </td>
                                                <td>{{ $rol->id > 4 ? ($rol->id == 5 ? $usuario->empleado->telefono_celu : $usuario->persona->telefono_celu) : '---' }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin-usuario-editar', ['id' => $usuario->id]) }}"
                                                        class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin-usuario-eliminar', ['id' => $usuario->id]) }}"
                                                        class="d-inline form-eliminar" method="POST">
                                                        @csrf @method('delete')
                                                        <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                                            title="Eliminar este registro">
                                                            <i class="fa fa-fw fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/usuario/usuario.js') }}"></script>
@endsection
<!-- ************************************************************* -->
