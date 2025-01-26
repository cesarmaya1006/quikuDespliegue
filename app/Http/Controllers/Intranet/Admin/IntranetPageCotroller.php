<?php

namespace App\Http\Controllers\Intranet\Admin;

use App\Models\PQR\PQR;
use App\Models\PQR\tipoPQR;
use App\Models\PQR\Peticion;
use Illuminate\Http\Request;
use App\Models\Admin\Usuario;
use App\Models\PQR\AsignacionTarea;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidarPassword;
use App\Models\Admin\Rol;
use App\Models\Empleados\Empleado;
use App\Models\PQR\Estado;

class IntranetPageCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoPQR = tipoPQR::all();
        $usuario = Usuario::findOrFail(session('id_usuario'));
        $tareas = AsignacionTarea::where('empleado_id', $usuario->id)->get();
        if (session('rol_id') == 6) {
            if ($usuario->persona->count() > 0) {
                $pqrs = PQR::where('persona_id', session('id_usuario'))->get();
            } else {
                foreach ($usuario->representante->empresas as $empresa) {
                    $pqrs = PQR::where('empresa_id', session('id_usuario'))->get();
                }
            }
        } elseif (session('rol_id') == 5) {
            if ($usuario->empleado->cargo->id == 1) {
                $pqrs = PQR::all();
                $pqrs = $pqrs->where("estado_creacion", 1);
            } else {
                $pqrs = PQR::where('empleado_id', $usuario->id)->get();
            }
        } elseif (session('rol_id') == 4) {
            $pqrs = PQR::where('empleado_id', session('id_usuario'))->get();
        } elseif (session('rol_id') == 1) {
            $pqrs = PQR::get();
        } elseif (session('rol_id') == 3) {
            $pqrs = PQR::get();
        }else{
            $pqrs = PQR::get();
        }
        $peticiones = Peticion::where('empleado_id', session('id_usuario'))->where('estado_id', '<', 11 )->get();
        $estadospqr = Estado::get();
        foreach ($estadospqr as $estado) {
            switch ($estado->id) {
                case '1':
                    $estado['bg'] = 'bg-info';
                    break;
                case '2':
                    $estado['bg'] = 'bg-primary';
                    break;
                case '3':
                    $estado['bg'] = 'bg-warning';
                    break;
                case '4':
                    $estado['bg'] = 'bg-danger';
                    break;
                case '5':
                    $estado['bg'] = 'bg-secondary';
                    break;
                case '6':
                    $estado['bg'] = 'bg-success';
                    break;
                case '7':
                    $estado['bg'] = 'bg-info';
                    break;
                case '8':
                    $estado['bg'] = 'bg-primary';
                    break;
                case '9':
                    $estado['bg'] = 'bg-success';
                    break;
                default:
                    $estado['bg'] = 'bg-success';
                    break;
            }
        }
        $empleados_find = Empleado::get();
        foreach ($empleados_find as $empleado) {
            $empleado['cantidad'] = $empleado->pqrs->whereNotIn('estadospqr_id',[6, 9, 10])->count();
        }
        $empleados = $empleados_find->sortBy('cantidad')->reverse()->take(10);
        foreach ($empleados as $empleado) {
            $dataPoints[] = ['y'=>$empleado->cantidad,'label'=> $empleado->nombre1 . ' ' . $empleado->apellido1];
        }
        $roles = Rol::get();
        return view('intranet.index.index', compact('pqrs', 'usuario', 'tipoPQR', 'tareas', 'peticiones','estadospqr','empleados','dataPoints','roles'));
    }

    public function restablecer_password(ValidarPassword $request)
    {
        $nuevoPassword['password'] = bcrypt(utf8_encode($request['password1']));
        $nuevoPassword['camb_password'] = 0;
        Usuario::findOrFail($request['id'])->update($nuevoPassword);
        return redirect('admin/index')->with('mensaje', 'Se cambio la contraseña de manera exitosa en la plataforma');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
