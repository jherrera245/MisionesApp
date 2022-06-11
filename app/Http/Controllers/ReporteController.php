<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $departamentos = DB::table('departamento')->where('status','=','1')->get();
        $capacitaciones = DB::table('capacitacion')->where('status','=','1')->get();

        return view('reportes.index', [
            "departamentos" => $departamentos, "capacitaciones" => $capacitaciones
        ]);
    }

    public function reporteDeEmpleados(Request $request)
    {
        if ($request) {
            $query = trim($request->get('departamento'));
            $all = ($query == "Todos") ? "" : $query;

            $empleados = DB::table('capacitacion_empleado as inscripcion')
            ->join('empleado as emp', 'inscripcion.id_empleado', '=', 'emp.id')
            ->join('departamento as dep', 'emp.id_departamento', '=', 'dep.id')
            ->join('cargo', 'emp.id_cargo', '=', 'cargo.id')
            ->select(DB::raw('COUNT(inscripcion.id_capacitacion) as total'), 'emp.nombres', 'emp.apellidos', 'cargo.nombre as cargo', 'dep.nombre as departamento')
            ->where('dep.nombre','=', $query)
            ->orwhere('dep.nombre','LIKE', '%'.$all.'%')
            ->groupBy('emp.nombres', 'emp.apellidos', 'cargo','dep.nombre')
            ->orderBy('dep.nombre','asc')   
            ->get();
    
            $pdf = PDF::loadView('reportes.reporte-empleados', ["empleados"=>$empleados, "departamento"=>$query]);
            return $pdf->stream();
        }
    }

    public function reporteCapacitaciones(Request $request)
    {
        if ($request) {
            $query = trim($request->get('capacitacion'));
            $inscripcion = DB::table('capacitacion_empleado as inscripcion')
            ->join('capacitacion as cap', 'cap.id', '=', 'inscripcion.id_capacitacion')
            ->join('modalidad_capacitacion as modalidad', 'cap.id_modalidad', '=', 'modalidad.id')
            ->select(DB::raw('SUM(cap.costo) as total'), 'modalidad.modalidad')
            ->where('cap.nombre_capacitacion', '=', $query)->where('inscripcion.status','=','1')
            ->groupBy('modalidad.modalidad')->first();

            $empleados = DB::table('capacitacion_empleado as inscripcion')
            ->join('capacitacion as cap', 'inscripcion.id_capacitacion', '=', 'cap.id')
            ->join('empleado as emp', 'inscripcion.id_empleado', '=', 'emp.id')
            ->join('estado_capacitacion as estado', 'inscripcion.id_estado_capacitacion', '=', 'estado.id')
            ->select(DB::raw('DISTINCT(emp.id)'),'emp.nombres','emp.apellidos', 'estado.estado_capacitacion as estado')
            ->where('inscripcion.status','=','1')->where('cap.nombre_capacitacion','LIKE','%'.$query.'%')
            ->get();

            $pdf = PDF::loadView('reportes.reporte-capacitaciones', [
                "empleados"=>$empleados, "capacitacion"=>$query, "inscripcion" =>$inscripcion
            ]);
            return $pdf->stream();
        }
    }

    public function reporteDepartamentos(){
        $departamentos = DB::table("departamento as dep")
        ->join("empleado as emp", 'emp.id_departamento', '=', 'dep.id')
        ->select(DB::raw('COUNT(emp.id_departamento) as total'), 'dep.nombre')
        ->groupBy('dep.nombre')->orderBy('dep.nombre', 'asc')
        ->get();
        $pdf = PDF::loadView('reportes.reporte-departamentos', ["departamentos"=>$departamentos]);
        return $pdf->stream();
    }

    public function reporteInversion(){

        $inscripciones = DB::table('capacitacion_empleado as inscripcion')
        ->join('capacitacion as cap', 'cap.id', '=', 'inscripcion.id_capacitacion')
        ->select(DB::raw('SUM(cap.costo) as total'), 'cap.nombre_capacitacion')
        ->where('inscripcion.status','=','1')
        ->groupBy('cap.nombre_capacitacion')->get();

        $pdf = PDF::loadView('reportes.reporte-inversiones', ["inscripciones"=>$inscripciones]);
        return $pdf->stream();
    }
}
