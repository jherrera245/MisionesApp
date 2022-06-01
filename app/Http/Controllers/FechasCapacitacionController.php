<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FechasCapacitacion;
use App\Http\Requests\FechasCapacitacionRequest;
use DB;

class FechasCapacitacionController extends Controller
{
    //registro de datos
    public function store(FechasCapacitacionRequest $request)
    {
        $horario = new FechasCapacitacion();
        $horario->id_capacitacion = $request->get('capacitacion');
        $horario->fecha = $request->get('fecha');
        $horario->hora_inicio = $request->get('entrada');
        $horario->hora_fin = $request->get('salida');
        $horario->save();

        return redirect("/capacitaciones/".$request->get('capacitacion'));
    }

    public function edit($id){
        $horario = FechasCapacitacion::find($id);
        return view('capacitaciones.capacitaciones.edit-horario', ["horario"=>$horario]);
    }

    public function update(FechasCapacitacionRequest $request, $id)
    {
        $horario = FechasCapacitacion::find($id);
        $horario->fecha = $request->get('fecha');
        $horario->hora_inicio = $request->get('entrada');
        $horario->hora_fin = $request->get('salida');
        $horario->update();
        return redirect("/capacitaciones/".$horario->id_capacitacion);
    }

    public function destroy($id)
    {
        $horario = FechasCapacitacion::find($id);
        $id_capacitacion = $horario->id_capacitacion;
        $horario->status=false;
        $horario->update();
        return redirect("/capacitaciones/".$id_capacitacion);
    }
}
