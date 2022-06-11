<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Http\Requests\DepartamentoRequest;
use DB;

class DepartamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        if ($request) {
            //consultamos la tabla de
            $query = trim($request->get('searchText'));
            $departamentos = DB::table('departamento as dep')
            ->select('dep.id', 'dep.nombre')
            ->where('dep.nombre', 'LIKE', '%'.$query.'%')
            ->where('dep.status','=','1')
            ->orderBy('dep.id','desc')
            ->paginate(7);

            return view('empleados.departamentos.index', ['departamentos'=>$departamentos, "searchText" => $query]);
        }
    }

    // vista create o formulario de registro
    public function create()
    {
        return view('empleados.departamentos.create');
    }

    // almacenamiento de registros
    public function store(DepartamentoRequest $request) 
    {
        $departamento = new Departamento();
        $departamento->nombre=$request->get('nombre');
        $departamento->save();
        return redirect('/departamentos');
    }

    // cargamos los datos del departamento para enviarlos a la vista edit
    public function edit($id)
    {
        $departamento = Departamento::find($id);
        return view('empleados.departamentos.edit', ["departamento" => $departamento]);
    }

    // actualizar registros
    public function update(DepartamentoRequest $request, $id) 
    {
        $departamento = Departamento::find($id);
        $departamento->nombre=$request->get('nombre');
        $departamento->update();
        return redirect('/departamentos');
    }

    // eliminar registros
    public function destroy($id)
    {
        $departamento = Departamento::find($id);
        $departamento->status=false;
        $departamento->update();
        return redirect('/departamentos');
    }
}
