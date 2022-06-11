<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capacitacion;
use App\Http\Requests\CapacitacionRequest;
use DB;

class CapacitacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //cargar datos en la vista index
    public function index(Request $request)
    {
        if ($request) {
            //consultamos la tabla
            $query = trim($request->get('searchText'));
            $capacitaciones = DB::table('capacitacion as cap')
            ->join('modalidad_capacitacion as mod_cap', 'cap.id_modalidad', '=', 'mod_cap.id')
            ->select(
                'cap.id','cap.nombre_capacitacion', 'cap.fecha_inicio', 'cap.fecha_finalizacion', 
                'mod_cap.modalidad', 'cap.cantidad_horas', 'cap.costo')
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
        $capacitacion = CapacitacionController::getCapacitacion($id);
        $financiamiento_capacitacion = CapacitacionController::getFinanciamientosCapacitacion($id);
        $horarios = CapacitacionController::getHorariosCapacitacion($id);
        $financiamientos = CapacitacionController::listFinanciamientos();

        $datos = [
            "capacitacion"=>$capacitacion, 
            "financiamiento_capacitacion"=>$financiamiento_capacitacion, 
            "horarios"=>$horarios,
            "financiamientos"=>$financiamientos
        ];
        return view('capacitaciones.capacitaciones.show', $datos);
    }


    //Obtenemos datos de la capacitacion para vista show
    private function getCapacitacion($id){
        $capacitacion = DB::table('capacitacion as cap')
        ->join('modalidad_capacitacion as mod_cap', 'cap.id_modalidad', '=', 'mod_cap.id')
        ->select('cap.id','cap.nombre_capacitacion', 'cap.fecha_inicio', 'cap.fecha_finalizacion', 'mod_cap.modalidad', 'cap.cantidad_horas', 'cap.costo', 'cap.descripcion')
        ->where('cap.status','=','1')->where('cap.id','=',$id)->first();

        return $capacitacion;
    }

    // obtenemos los datos de los financiamientos de la capacitacion
    private function getFinanciamientosCapacitacion($id)
    {
        $financiamientos = DB::table('financiamiento_capacitacion as f_cap')
        ->join('financiamiento as f', 'f_cap.id_financiamiento','=','f.id')
        ->join('capacitacion as cap', 'f_cap.id_capacitacion', '=', 'cap.id')
        ->select('f_cap.id','f.fuente_financiamiento')
        ->where('f_cap.id_capacitacion','=',$id)
        ->where('f_cap.status','=','1')
        ->get();

        return $financiamientos;
    }

    // lista de finanaicamientos para select
    private function listFinanciamientos()
    {
        $financiamientos = DB::table('financiamiento')->where('status','=','1')->get();
        return $financiamientos;
    }

    //obtenemos los horarios de la capacitacion
    private function getHorariosCapacitacion($id)
    {
        $horarios = DB::table('fechas_capacitacion as horario')
        ->join('capacitacion as cap', 'horario.id_capacitacion', '=', 'cap.id')
        ->select('horario.id','horario.fecha','horario.hora_inicio', 'horario.hora_fin')
        ->where('horario.id_capacitacion','=',$id)
        ->where('horario.status','=','1')
        ->orderBy('horario.fecha','asc')
        ->paginate(7);

        return $horarios;
    }

    //Vista create
    public function create()
    {
        $modalidades = DB::table('modalidad_capacitacion')->where('status','=','1')->get();
        return view('capacitaciones.capacitaciones.create', ["modalidades"=>$modalidades]);
    }

    //alamacenamiento de los registros
    public function store(CapacitacionRequest $request)
    {
        $capacitacion = new Capacitacion();
        $capacitacion->nombre_capacitacion = $request->get('nombre');
        $capacitacion->fecha_inicio = $request->get('inicio');
        $capacitacion->fecha_finalizacion = $request->get('fin');
        $capacitacion->id_modalidad = $request->get('modalidad');
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
        $modalidades = DB::table('modalidad_capacitacion')->where('status','=','1')->get();
        return view('capacitaciones.capacitaciones.edit',["capacitacion"=>$capacitacion, "modalidades"=>$modalidades]);
    }

    //actualizar registros
    public function update(CapacitacionRequest $request, $id)
    {
        $capacitacion = Capacitacion::find($id);
        $capacitacion->nombre_capacitacion = $request->get('nombre');
        $capacitacion->fecha_inicio = $request->get('inicio');
        $capacitacion->fecha_finalizacion = $request->get('fin');
        $capacitacion->id_modalidad = $request->get('modalidad');
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
