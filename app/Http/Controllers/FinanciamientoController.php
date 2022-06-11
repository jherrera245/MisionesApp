<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Financiamiento;
use App\Http\Requests\FinanciamientoRequest;
use DB;

class FinanciamientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

     // carga los datos de la base de datos en una tabla
     public function index(Request $request)
     {
         if ($request) {
             //consultamos la tabla
             $query = trim($request->get('searchText'));
             $financiamientos = DB::table('financiamiento as f')
             ->select('f.id', 'f.fuente_financiamiento')
             ->where('f.fuente_financiamiento', 'LIKE', '%'.$query.'%')
             ->where('f.status','=','1')
             ->orderBy('f.id','desc')
             ->paginate(7);
 
             return view('capacitaciones.financiamientos.index', ["financiamientos"=>$financiamientos, "searchText" => $query]);
         }
     }
 
     // vista create o formulario de registro
     public function create()
     {
         return view('capacitaciones.financiamientos.create');
     }
 
     // almacenamientos de registros
     public function store(FinanciamientoRequest $request)
     {
         $financiamiento = new Financiamiento();
         $financiamiento->fuente_financiamiento=$request->get('fuente');
         $financiamiento->save();
         return redirect('/financiamientos');
     }
 
     //cargamos los datos del financiamiento para enviarlos a la vista edit
     public function edit($id)
     {
         $financiamiento = Financiamiento::find($id);
         return view('capacitaciones.financiamientos.edit', ['financiamiento'=>$financiamiento]);
     }
 
     //actualizar los registros
     public function update(FinanciamientoRequest $request, $id)
     {
         $financiamiento = Financiamiento::find($id);
         $financiamiento->fuente_financiamiento=$request->get('fuente');
         $financiamiento->update();
         return redirect('/financiamientos');
     }
 
     // eliminar registros
     public function destroy($id)
     {
         $financiamiento = Financiamiento::find($id);
         $financiamiento->status=false;
         $financiamiento->update();
         return redirect('/financiamientos');
     }
}
