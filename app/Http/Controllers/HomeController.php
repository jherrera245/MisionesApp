<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalEmpleados = HomeController::countEmpleados();
        $totalCapacitaciones = HomeController::countCapacitaciones();
        $totalCargos = HomeController::countCargos();
        $totalInversion = HomeController::countInversiones();

        $resource = [
            "incluir_graficas"=>true,
            "totalEmpleados"=>$totalEmpleados,
            "totalCapacitaciones"=>$totalCapacitaciones,
            "totalCargos"=>$totalCargos,
            "totalInversion"=>$totalInversion,
        ];
        return view('home.index', $resource);
    }

    /**
     * @return json_encode
     */
    public function DataEmpladosPorDepartamento()
    {
        $count = DB::table('empleado as emp')
        ->join('departamento as dep', 'emp.id_departamento', '=', 'dep.id')
        ->select(
            'dep.nombre',
            DB::raw("COUNT(emp.id_departamento) as total")
        )
        ->groupBy('dep.nombre')
        ->get();

        return json_encode($count);
    }

    /**
     * @return json_encode
     */
    public function DataEmpladosPorCapacitacion()
    {
        $count = DB::table('capacitacion_empleado as inscripcion')
        ->join('empleado as emp', 'emp.id', '=', 'inscripcion.id_empleado')
        ->join('capacitacion as cap', 'cap.id', '=', 'inscripcion.id_capacitacion')
        ->select(
            'cap.nombre_capacitacion',
            DB::raw("COUNT(inscripcion.id_capacitacion) as total")
        )
        ->groupBy('cap.nombre_capacitacion')
        ->orderBy('total', 'desc')
        ->take(10)
        ->get();

        return json_encode($count);
    }

    // contar el total de empleados
    private function countEmpleados()
    {
        $empleados = DB::table('empleado')->where('status','=','1')->count();
        return $empleados;
    }

    // contar total de capacitaciones
    private function countCapacitaciones()
    {
        $capacitaciones = DB::table('capacitacion')->where('status','=','1')->count();
        return $capacitaciones;
    }

    // contar total de cargo
    private function countCargos()
    {
        $cargos = DB::table('cargo')->where('status','=','1')->count();
        return $cargos;
    }

    // calcular costo de inversiones
    private function countInversiones()
    {
        $inscripcion = DB::table('capacitacion_empleado as inscripcion')
        ->join('capacitacion as cap', 'cap.id', '=', 'inscripcion.id_capacitacion')
        ->select(
            DB::raw('SUM(cap.costo) as total')
        )
        ->where('inscripcion.status','=','1')
        ->first();

        $total  = ($inscripcion->total == null) ? 0 : $inscripcion->total;
        
        return $total;
    }
}
