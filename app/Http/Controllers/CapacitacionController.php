<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capacitacion;
use App\Http\Requests\CapacitacionRequest;
use DB;

class CapacitacionController extends Controller
{
    //cargar datos en la vista index
    public function index(Request $request)
    {
        if ($request) {
            //consultamos la tabla
            $query = trim($request->get('searchText'));
            $capacitaciones = DB::table('capacitacion as cap')
            ->select(
                'cap.id','cap.nombre_capacitacion', 'cap.fecha_inicio', 'cap.fecha_finalizacion', 
                'cap.modalidad', 'cap.cantidad_horas', 'cap.costo')
            ->where('cap.nombre_capacitacion','LIKE','%'.$query.'%')
            ->where('cap.status','=','1')
            ->orderBy('cap.id','desc')
            ->paginate(7);

            return view('capacitaciones.capacitaciones.index',["capacitaciones"=>$capacitaciones, 'searchText'=>$query]);
        }
    }

    //buscar registro para mostrar detalles del registro
    public function show($id)
    {
        $capacitacion=Capacitacion::find($id);

        $financiamientos = DB::table('financiamiento_capacitacion as f_cap')
        ->join('financiamiento as f', 'f_cap.id_financiamiento','=','f.id')
        ->join('capacitacion as cap', 'f_cap.id_capacitacion', '=', 'cap.id')
        ->select('f.fuente_financiamiento')
        ->where('f_cap.id_capacitacion','=',$id)
        ->get();

        $horarios = DB::table('fechas_capacitacion as horario')
        ->join('capacitacion as cap', 'horario.id_capacitacion', '=', 'cap.id')
        ->select('horario.fecha','horario.hora')
        ->where('horario.id_capacitacion','=',$id)
        ->get();

        $datos = ["capacitacion"=>$capacitacion, "financiamientos"=>$financiamientos, "horarios"=>$horarios];
        return view('capacitaciones.capacitaciones.show', $datos);
    }

    //Vista create
    public function create()
    {
        return view('capacitaciones.capacitaciones.create');
    }

    //alamacenamiento de los registros
    public function store(CapacitacionRequest $request)
    {
        $capacitacion = new Capacitacion();
        $capacitacion->nombre_capacitacion = $request->get('nombre');
        $capacitacion->fecha_inicio = $request->get('inicio');
        $capacitacion->fecha_finalizacion = $request->get('fin');
        $capacitacion->modalidad = $request->get('modalidad');
        $capacitacion->descripcion = $request->get('descripcion');
        $capacitacion->cantidad_horas = $request->get('horas');
        $capacitacion->costo = $request->get('costo');
        $capacitacion->save();

        return redirect('/capacitaciones');
    }

    //buscar registro para enviarlo los datos a la vista edit
    public function edit($id)
    {
        $capacitacion=Capacitacion::find($id);
        return view('capacitaciones.capacitaciones.edit',["capacitacion"=>$capacitacion]);
    }

    //actualizar registros
    public function update(CapacitacionRequest $request, $id)
    {
        $capacitacion = Capacitacion::find($id);
        $capacitacion->nombre_capacitacion = $request->get('nombre');
        $capacitacion->fecha_inicio = $request->get('inicio');
        $capacitacion->fecha_finalizacion = $request->get('fin');
        $capacitacion->modalidad = $request->get('modalidad');
        $capacitacion->descripcion = $request->get('descripcion');
        $capacitacion->cantidad_horas = $request->get('horas');
        $capacitacion->costo = $request->get('costo');
        $capacitacion->update();

        return redirect('/capacitaciones');
    }

    //eliminar registros
    public function destroy($id)
    {
        $capacitacion = Capacitacion::find($id);
        $capacitacion->status=false;
        $capacitacion->update();
        return redirect('/capacitaciones');
    }
}
