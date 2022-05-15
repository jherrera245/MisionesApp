<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NivelAcademico;
use App\Http\Requests\NivelAcademicoRequest;
use DB;

class NivelAcademicoController extends Controller
{
    public function index(Request $request)
    {
        if ($request) {
            //consultamos la tabla de
            $query = trim($request->get('searchText'));
            $niveles = DB::table('nivel_academico as nivel')
            ->select('nivel.id', 'nivel.nombre')
            ->where('nivel.nombre', 'LIKE', '%'.$query.'%')
            ->where('nivel.status','=','1')
            ->orderBy('nivel.id','desc')
            ->paginate(7);

            return view('empleados.niveles.index', ['niveles'=>$niveles, "searchText" => $query]);
        }
    }

    // vista create o formulario de registro
    public function create()
    {
        return view('empleados.niveles.create');
    }

    // almacenamiento de registros
    public function store(NivelAcademicoRequest $request) 
    {
        $nivel = new NivelAcademico();
        $nivel->nombre=$request->get('nombre');
        $nivel->save();
        return redirect('/nivel_academico');
    }

    // cargamos los datos del nivel para enviarlos a la vista edit
    public function edit($id)
    {
        $nivel = NivelAcademico::find($id);
        return view('empleados.niveles.edit', ["nivel" => $nivel]);
    }

    // actualizar registros
    public function update(NivelAcademicoRequest $request, $id) 
    {
        $nivel = NivelAcademico::find($id);
        $nivel->nombre=$request->get('nombre');
        $nivel->update();
        return redirect('/nivel_academico');
    }

    // eliminar registros
    public function destroy($id)
    {
        $nivel = NivelAcademico::find($id);
        $nivel->status=false;
        $nivel->update();
        return redirect('/nivel_academico');
    }
}
