<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Http\Requests\CargoRequest;
use DB;

class CargoController extends Controller
{
    // carga los datos de la base de datos en una tabla
    public function index(Request $request)
    {
        if ($request) {
            //consultamos la tabla
            $query = trim($request->get('searchText'));
            $cargos = DB::table('cargo as c')
            ->select('c.id', 'c.nombre')
            ->where('c.nombre', 'LIKE', '%'.$query.'%')
            ->where('c.status','=','1')
            ->orderBy('c.id','desc')
            ->paginate(7);

            return view('empleados.cargos.index', ["cargos"=>$cargos, "searchText" => $query]);
        }
    }

    // vista create o formulario de registro
    public function create()
    {
        return view('empleados.cargos.create');
    }

    // almacenamientos de registros
    public function store(CargoRequest $request)
    {
        $cargo = new Cargo();
        $cargo->nombre=$request->get('nombre');
        $cargo->save();
        return redirect('/cargos');
    }

    //cargamos los datos del cargo para enviarlos a la vista edit
    public function edit($id)
    {
        $cargo = Cargo::find($id);
        return view('empleados.cargos.edit', ['cargo'=>$cargo]);
    }

    //actualizar los registros
    public function update(CargoRequest $request, $id)
    {
        $cargo = Cargo::find($id);
        $cargo->nombre=$request->get('nombre');
        $cargo->update();
        return redirect('/cargos');
    }

    // eliminar registros
    public function destroy($id)
    {
        $cargo = Cargo::find($id);
        $cargo->status=false;
        $cargo->update();
        return redirect('/cargos');
    }
}
