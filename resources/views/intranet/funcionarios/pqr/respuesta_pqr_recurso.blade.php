<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta</title>
    <style>

        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 3cm 2cm 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
            color: rgb(0, 0, 0);
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
            color: rgb(0, 0, 0);
            text-align: center;
            line-height: 35px;
            padding-bottom: 2px;
        }
        
        p {
            font-size: 12pt;
            text-align: justify;
        }

        table {
            width: 90%;
            margin: auto;
        }
        .p-azul {
            font-size: 13px;
            color: #3359fa;
            line-height: .5;
        }
    </style>
</head>

<body>
    <header  style="margin-top: 30px">
        <table>
            <tr>
                <td style="width: 40%;text-align: center;">
                    <img src="{{ $imagen }}" alt="" style="width: 100%;max-width: 150px;">
                </td>
                <td style="width: 60%;">
                    <div style=" width: 100%;text-align: center;font-weight: bold;font-size: 16pt;">
                        <h5 style="color: #3359fa;">Sistema Quiku</h5>
                    </div>
                </td>
            </tr>
        </table>
    </header>

    <main>
        <table>
            <tr>
                <td>
                    <div style="margin-top: 15px;">
                        <p>Señor(a)</p>
                        {{-- Bloque para peticionario persona natural --}}
                        @if($pqr->persona_id)
                            <p><strong>{{ $pqr->persona->nombre1 . ' ' . $pqr->persona->nombre2 . ' ' . $pqr->persona->apellido1 . ' ' . $pqr->persona->apellido2 }}</strong></p>
                            <p>{{ $pqr->persona->tipos_docu->tipo_id }} No. {{ $pqr->persona->identificacion }}</p>
                            @if($pqr->persona->email)
                                <p>E-mail: {{ $pqr->persona->email }} </p>
                            @else
                                <p>Dirección: {{ $pqr->persona->direccion }}</p>
                            @endif 
                        {{-- Bloque para peticionario persona jurídica
                        @elseif($pqr->empresa_id)
                            {{-- <p><strong>{{ $pqr->persona->nombre1 . ' ' . $pqr->persona->nombre2 . ' ' . $pqr->persona->apellido1 . ' ' . $pqr->persona->apellido2 }}</strong></p>
                            <p>{{ $tipo_doc }} No. {{ $identificacion }}</p>
                            @if($email)
                                <p>E-mail: {{ $email }} </p>
                            @else
                                <p>Dirección: {{ $email }}</p>
                            @endif --}}
                        @endif
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <p>Referencia: {{ $pqr->num_radicado }}</p>
                    <p>Asunto: Respuesta a su recurso.</p>
                </td>
            </tr>
            <tr>
                <td>
                    @if($pqr->persona_id)
                        <p>Respetado(a) señor(a) {{ $pqr->persona->nombre1 . ' ' . $pqr->persona->nombre2 . ' ' . $pqr->persona->apellido1 . ' ' . $pqr->persona->apellido2 }} </p>
                    @elseif($pqr->empresa_id)
                        <p>Respetado(a) señor(a) {{ $pqr->persona->nombre1 . ' ' . $pqr->persona->nombre2 . ' ' . $pqr->persona->apellido1 . ' ' . $pqr->persona->apellido2 }} </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <p>En atención a su comunicación del {{ $pqr->fecha_radicado}}, mediante la cual nos formula la PQR {{ $pqr->radicado}}, nos permitimos responder sus solicitudes en el mismo orden en el que fueron formuladas.</p>
                </td>
            </tr>
        </table>
        <table>
            @foreach($pqr->peticiones as $key => $peticion)
            <tr>
                <td>
                    @php
                        $recurso = $peticion->recursos->where('tipo_reposicion_id', $tipo_respuesta);  
                        if(sizeOf($recurso)){
                            if($tipo_respuesta == 1){
                                $recursoContent = $recurso[0];
                            }elseif($tipo_respuesta == 2){
                                if($pqr->recurso_aclaracion){
                                    $recursoContent = $recurso[1];
                                }else{
                                    $recursoContent = $recurso[0];
                                }
                            }elseif($tipo_respuesta == 3){
                                $contador = $pqr->recurso_aclaracion + $pqr->recurso_reposicion;
                                if($contador == 2){
                                    $recursoContent = $recurso[2];
                                }elseif($contador == 1){
                                    $recursoContent = $recurso[1];
                                }else{
                                    $recursoContent = $recurso[0];
                                }
                            }
                        }
                    @endphp
                    @if(sizeOf($recurso))
                        <p><strong>Solicitud {{$key + 1}}: </strong> "{{ $recursoContent->recurso }}"</p>
                        @if($recursoContent->respuestarecurso)
                            <p>Respuesta:</p>
                            <p>{!! $recursoContent->respuestarecurso->respuesta !!}</p>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
            <tr>
                <td>En mérito de lo expuesto,</td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <h4 style="text-align: center;">RESUELVE</h4>
                    @foreach($resuelves as $key => $resuelve)
                        <p style="text-transform: capitalize;"><strong>{{$resuelve->numeracion->ordinal}} :</strong></p>
                        <p>{!! $resuelve->resuelve !!}</p>
                    @endforeach
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <p>Cordialmente,</p>
                </td>
            </tr>
            <tr>
                <td>
                    
                    @php
                        $aprueba = $pqr->asignaciontareas->where('tareas_id', 4)[3];
                    @endphp
                    @if($firma && $firma != '') 
                        <img src="{{ $firma }}" class="" alt="firma">
                    @else
                        <p style="font-style: italic;">* Espacio para estanpar firma electrónica</p>
                    @endif
                    <p style="font-weight: bold;">{{ $aprueba->empleado->nombre1 . ' ' .$aprueba->empleado->nombre2 . ' ' . $aprueba->empleado->apellido1 . ' ' . $aprueba->empleado->apellido2}}</p>
                    <p>{{ $aprueba->empleado->cargo->cargo}}</p>
                </td>
            </tr>
            <tr>
                <td>
                    @php
                        $tareas = $pqr->asignaciontareas;
                    @endphp
                    @foreach($tareas as $key => $tarea)
                        @if($tarea->tareas_id == 2)    
                            <p style="font-size: 11px; line-height: 1px;">Proyectó: {{$tarea->empleado->nombre1 . ' ' . $tarea->empleado->nombre2 . ' ' . $tarea->empleado->apellido1 . ' ' .$tarea->empleado->apellido2}}</p>
                        @elseif($tarea->tareas_id == 3)
                            <p style="font-size: 11px; line-height: 1px;">Revisó: {{$tarea->empleado->nombre1 . ' ' . $tarea->empleado->nombre2 . ' ' . $tarea->empleado->apellido1 . ' ' .$tarea->empleado->apellido2}}</p>
                        @elseif($tarea->tareas_id == 4)
                            <p style="font-size: 11px; line-height: 1px;">Aprovó: {{$tarea->empleado->nombre1 . ' ' . $tarea->empleado->nombre2 . ' ' . $tarea->empleado->apellido1 . ' ' .$tarea->empleado->apellido2}}</p>
                        @endif
                    @endforeach
                </td>
            </tr>
        </table>
    </main>

    <footer>
        <table>
            <tr>
                <td>
                    <div style="footer width: 100%;text-align: center;font-weight: bold;font-size: 0.6em;">
                        <p class="p-azul">57-1-7229497</p>
                        <p class="p-azul">www.mglasociados.com</p>
                        <p class="p-azul">Carrera 13 # 76-12 Of. 301 y Carrera 5 # 16-14 Of. 803</p>
                        <p class="p-azul">3208380622</p>
                    </div>
                </td>
            </tr>
        </table>
    </footer>
</body>

</html>
