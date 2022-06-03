<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoCapacitacion;
use App\Http\Requests\EstadoCapacitacionRequest;
use DB;

class EstadoCapacitacionController extends Controller
{
    public function index(Request $request)
    {
        if ($request) {
            //consultamos la tabla de
            $query = trim($request->get('searchText'));
            $estados = DB::table('estado_capacitacion as estado')
            ->select('estado.id', 'estado.estado_capacitacion')
            ->where('estado.estado_capacitacion', 'LIKE', '%'.$query.'%')
            ->where('estado.status','=','1')
            ->orderBy('estado.id','desc')
            ->paginate(7);

            return view('capacitaciones.estados.index', ['estados'=>$estados, "searchText" => $query]);
        }
    }

    // vista create o formulario de registro
    public function create()
    {
        return view('capacitaciones.estados.create');
    }

    // almacenamiento de registros
    public function store(EstadoCapacitacionRequest $request) 
    {
        $estado = new EstadoCapacitacion();
        $estado->estado_capacitacion=$request->get('estado');
        $estado->save();
        return redirect('/estados');
    }

    // cargamos los datos del estado para enviarlos a la vista edit
    public function edit($id)
    {
        $estado = EstadoCapacitacion::find($id);
        return view('capacitaciones.estados.edit', ["estado" => $estado]);
    }

    // actualizar registros
    public function update(EstadoCapacitacionRequest $request, $id) 
    {
        $estado = EstadoCapacitacion::find($id);
        $estado->estado_capacitacion = $request->get('estado');
        $estado->update();
        return redirect('/estados');
    }

    // eliminar registros
    public function destroy($id)
    {
        $estado = EstadoCapacitacion::find($id);
        $estado->status=false;
        $estado->update();
        return redirect('/estados');
    }
}
