<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Http\Requests\EmpleadoRequest;
use DB;

class EmpleadoController extends Controller
{

    //cargar datos de bd en la vista
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $empleados = DB::table('empleado as emp')
            ->join('nivel_academico as nivel', 'emp.id_nivel_academico', '=', 'nivel.id')
            ->join('departamento as dep', 'emp.id_departamento', '=', 'dep.id')
            ->join('cargo as c', 'emp.id_cargo', '=', 'c.id')
            ->select('emp.id', 'emp.nombres','emp.apellidos', 'nivel.nombre as nivel_academico', 'dep.nombre as departamento', 'c.nombre as cargo', 'emp.telefono', 'emp.coordinador')
            ->where(function($groupQuery) use ($query){
                $groupQuery->where('emp.nombres','LIKE', '%'.$query.'%')
                ->orwhere('emp.apellidos', 'LIKE', '%'.$query.'%')
                ->orwhere('c.nombre','LIKE', '%'.$query.'%')
                ->orwhere('dep.nombre','LIKE', '%'.$query.'%')
                ->orwhere('nivel.nombre','LIKE', '%'.$query.'%');
            })
            ->where('emp.status','=','1')
            ->orderBy('emp.id','desc')
            ->paginate(7);

            return view('empleados.empleados.index', ["empleados"=>$empleados, "searchText"=>$query]);
        }
    }

    //cargamos los datos en la vista de registro
    public function create()
    {
        $cargos = DB::table('cargo')->where('status','=','1')->get();
        $niveles = DB::table('nivel_academico')->where('status','=','1')->get();
        $departamentos = DB::table('departamento')->where('status','=','1')->get();

        return view('empleados.empleados.create', ["cargos"=>$cargos, "niveles"=>$niveles, "departamentos"=>$departamentos]);
    }

    //almacenamos los registros
    public function store(EmpleadoRequest $request)
    {
        $empleado = new Empleado();
        $empleado->nombres=$request->get('nombres');
        $empleado->apellidos=$request->get('apellidos');
        $empleado->dui=$request->get('dui');
        $empleado->id_nivel_academico=$request->get('nivel');
        $empleado->id_departamento=$request->get('departamento');
        $empleado->id_cargo=$request->get('cargo');
        $empleado->telefono=$request->get('telefono');
        $empleado->coordinador=($request->get('coordinador') == 1) ? 1 : 0;
        $empleado->save();

        return redirect('/empleados');
    }

    //cargamos los datos en la vista de edit
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        $cargos = DB::table('cargo')->where('status','=','1')->get();
        $niveles = DB::table('nivel_academico')->where('status','=','1')->get();
        $departamentos = DB::table('departamento')->where('status','=','1')->get();

        return view('empleados.empleados.edit', ["empleado"=>$empleado,"cargos"=>$cargos, "niveles"=>$niveles, "departamentos"=>$departamentos]);
    }

    //actualizar registros
    public function update(EmpleadoRequest $request, $id)
    {
        $empleado = Empleado::find($id);
        $empleado->nombres=$request->get('nombres');
        $empleado->apellidos=$request->get('apellidos');
        $empleado->dui=$request->get('dui');
        $empleado->id_nivel_academico=$request->get('nivel');
        $empleado->id_departamento=$request->get('departamento');
        $empleado->id_cargo=$request->get('cargo');
        $empleado->telefono=$request->get('telefono');
        $empleado->coordinador=($request->get('coordinador') == 1) ? 1 : 0;
        $empleado->update();

        return redirect('/empleados');
    }

    // eliminar registros
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        $empleado->status = false;
        $empleado->update();
        return redirect('/empleados');
    }
}
