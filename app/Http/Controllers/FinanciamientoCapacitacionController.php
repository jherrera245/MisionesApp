<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinanciamientoCapacitacion;
use App\Http\Requests\FinanciamientoCapacitacionRequest;
use DB;

class FinanciamientoCapacitacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // registrar financiamiento capacitacion
    public function store(FinanciamientoCapacitacionRequest $request){
        $financiamiento = new FinanciamientoCapacitacion();
        $financiamiento->id_capacitacion = $request->get('capacitacion');
        $financiamiento->id_financiamiento = $request->get('financiamiento');
        $financiamiento->save();

        return redirect("/capacitaciones/".$request->get('capacitacion'));
    }

    public function destroy($id)
    {
        $financiamiento = FinanciamientoCapacitacion::find($id);
        $id_capacitacion = $financiamiento->id_capacitacion;
        $financiamiento->status=false;
        $financiamiento->update();
        return redirect("/capacitaciones/".$id_capacitacion);
    }
    
}
