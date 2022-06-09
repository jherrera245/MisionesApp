<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapacitacionEmpleado;
use App\Http\Requests\CapacitacionEmpleadoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;
use DB;

class CapacitacionEmpleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request){
            $query = trim($request->get('searchText'));
            if (Auth::user()->is_admin==true) {
                $inscripciones = CapacitacionEmpleadoController::getDataCapacitacionEmpeladoAdmin($request, $query);
            }
            else{
                $inscripciones = CapacitacionEmpleadoController::getDataCapacitacionEmpeladoUser($request, $query);
            }

            return view('capacitaciones.inscripciones.index', ["inscripciones"=>$inscripciones, "searchText"=>$query]);
        }
    }

    //registros del user admin
    private function getDataCapacitacionEmpeladoAdmin($request, $query)
    {
        $inscripciones = DB::table('capacitacion_empleado as inscripcion')
        ->join('empleado as emp', 'inscripcion.id_empleado', '=', 'emp.id')
        ->join('capacitacion as cap', 'inscripcion.id_capacitacion', '=', 'cap.id')
        ->join('estado_capacitacion as estado', 'inscripcion.id_estado_capacitacion', '=', 'estado.id')
        ->select(
            'inscripcion.id', 'emp.nombres', 'emp.apellidos', 'cap.nombre_capacitacion', 'estado.estado_capacitacion', 
            'inscripcion.comprobante_inscripcion', 'inscripcion.comprobante_finalizacion'
        )
        ->where(function ($groupQuery) use ($query)
        {
            $groupQuery->where('emp.nombres', 'LIKE', '%'.$query.'%')
            ->orwhere('emp.apellidos', 'LIKE', '%'.$query.'%')
            ->orwhere('cap.nombre_capacitacion', 'LIKE', '%'.$query.'%');
        })
        ->where('inscripcion.status','=','1')
        ->orderBy('inscripcion.id', 'desc')
        ->paginate(7);

        return $inscripciones;
    }

    // capacitacion de un empleado no admin
    private function getDataCapacitacionEmpeladoUser($request, $query)
    {
        $inscripciones = DB::table('capacitacion_empleado as inscripcion')
        ->join('empleado as emp', 'inscripcion.id_empleado', '=', 'emp.id')
        ->join('capacitacion as cap', 'inscripcion.id_capacitacion', '=', 'cap.id')
        ->join('estado_capacitacion as estado', 'inscripcion.id_estado_capacitacion', '=', 'estado.id')
        ->select(
            'inscripcion.id', 'emp.nombres', 'emp.apellidos', 'cap.nombre_capacitacion', 'estado.estado_capacitacion', 
            'inscripcion.comprobante_inscripcion', 'inscripcion.comprobante_finalizacion'
        )
        ->where(function ($groupQuery) use ($query)
        {
            $groupQuery->where('emp.nombres', 'LIKE', '%'.$query.'%')
            ->orwhere('emp.apellidos', 'LIKE', '%'.$query.'%')
            ->orwhere('cap.nombre_capacitacion', 'LIKE', '%'.$query.'%');
        })
        ->where('inscripcion.status','=','1')
        ->where('inscripcion.id_empleado','=', Auth::user()->id_empleado)
        ->orderBy('inscripcion.id', 'desc')
        ->paginate(7);

        return $inscripciones;
    }

    // empleaos select
    private function getSeleccionEmpleados()
    {
        if (Auth::user()->is_admin == true) {
            $empleados = DB::table('empleado')->where('status','=','1')->get();
        }else{
            $empleados = DB::table('empleado')->where('status','=','1')->where('id','=', Auth::user()->id_empleado)->get();
        }
        return $empleados;
    }

    //mostramos la vista create
    public function create()
    {
        $capacitaciones = DB::table('capacitacion')->where('status','=','1')->get();
        $empleados = CapacitacionEmpleadoController::getSeleccionEmpleados();
        $estados = DB::table('estado_capacitacion')->where('status','=','1')->get();
        $datos = ["capacitaciones"=>$capacitaciones, "empleados"=>$empleados, "estados"=>$estados];
        return view('capacitaciones.inscripciones.create', $datos);
    }

    //guadar datos
    public function store(CapacitacionEmpleadoRequest $request)
    {
        $inscripcion = new CapacitacionEmpleado();
        $inscripcion->comprobante_inscripcion = CapacitacionEmpleadoController::guadarArchivoEnServidor(
            $request, 'inscripcion',"Comprobante-de-inscripcion-"
        );
        $inscripcion->comprobante_finalizacion = CapacitacionEmpleadoController::guadarArchivoEnServidor(
            $request, 'finalizacion',"Comprobante-de-finalizacion-"
        );
        $inscripcion->id_empleado = $request->get('empleado');
        $inscripcion->id_capacitacion = $request->get('capacitacion');
        $inscripcion->id_estado_capacitacion = $request->get('estado');
        $inscripcion->save();

        return redirect('/inscripciones');
    }

    private function generarNombreFile($idEmpleado, $idCapacitacion)
    {
        $empleado = DB::table('empleado')->select('nombres','apellidos')->where('id','=', $idEmpleado)->first();
        $capacitacion = DB::table('capacitacion')->select('nombre_capacitacion')->where('id','=', $idCapacitacion)->first();
        $fileName = $capacitacion->nombre_capacitacion."-de-".$empleado->nombres."-".$empleado->apellidos;
        $fileName = str_replace(' ', '-', $fileName).'-'.hash('sha256', random_int(0, 999999));
        return $fileName;
    }

    private function guadarArchivoEnServidor(CapacitacionEmpleadoRequest $request, $comprobante, $mensaje) 
    {
        $nombreFile = CapacitacionEmpleadoController::generarNombreFile($request->get('empleado'), $request->get('capacitacion'));
        if ($request->hasFile($comprobante)){
            $url = $request->file($comprobante);
            $file = $mensaje.trim($nombreFile).".".$url->guessExtension();
            //guardamos el archivo en el servidor
            Storage::disk('anexos')->put($file, File::get($url));
            return $file;
        }
    }

    private function borrarArchivoEnServidor(CapacitacionEmpleadoRequest $request, $newFile, $oldFile){
        if ($request->hasFile($newFile)) {
            File::delete('documentos/'.$oldFile);
            return true;
        }
        return false;
    }

    public function edit($id){
        $inscripcion = CapacitacionEmpleado::find($id);
        $capacitaciones = DB::table('capacitacion')->where('status','=','1')->get();
        $empleados = CapacitacionEmpleadoController::getSeleccionEmpleados();
        $estados = DB::table('estado_capacitacion')->where('status','=','1')->get();
        $datos = ["inscripcion"=>$inscripcion, "capacitaciones"=>$capacitaciones, "empleados"=>$empleados, "estados"=>$estados];
        return view('capacitaciones.inscripciones.edit', $datos);
    }

    //guadar datos
    public function update(CapacitacionEmpleadoRequest $request, $id)
    {
        $inscripcion = CapacitacionEmpleado::find($id);
        //borrar viejos comprobantes
        $oldFileInscripcion = $inscripcion->comprobante_inscripcion;
        $oldFileFinalizacion = $inscripcion->comprobante_finalizacion;
        $inscripcion->id_empleado = $request->get('empleado');
        $inscripcion->id_capacitacion = $request->get('capacitacion');
        $inscripcion->id_estado_capacitacion = $request->get('estado');

        if (CapacitacionEmpleadoController::borrarArchivoEnServidor($request, 'inscripcion', $oldFileInscripcion)) {
            $inscripcion->comprobante_inscripcion = CapacitacionEmpleadoController::guadarArchivoEnServidor(
                $request, 'inscripcion',"Comprobante-de-inscripcion-"
            );
        }

        if (CapacitacionEmpleadoController::borrarArchivoEnServidor($request, 'finalizacion', $oldFileFinalizacion)) {
            $inscripcion->comprobante_finalizacion = CapacitacionEmpleadoController::guadarArchivoEnServidor(
                $request, 'finalizacion',"Comprobante-de-finalizacion-"
            );
        }
        $inscripcion->update();
        return redirect('/inscripciones');
    }

    //borrar registros
    public function destroy($id){
        $inscripcion = CapacitacionEmpleado::find($id);
        $inscripcion->status=false;
        $inscripcion->update();
        return redirect('/inscripciones');
    }
}
