<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Http\Requests\ProfileUserRequest;
use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class UsuarioController extends Controller
{
    //contruct
    public function __construct(){
        $this->middleware('admin');
    }

    //cargar datos de bd en la vista
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $usuarios = DB::table('users as u')
            ->join('empleado as emp', 'u.id_empleado', '=', 'emp.id')
            ->select('u.id', 'u.name','u.email', 'u.is_admin', 'emp.nombres', 'emp.apellidos')
            ->where('emp.nombres','LIKE', '%'.$query.'%')
            ->orwhere('emp.apellidos', 'LIKE', '%'.$query.'%')
            ->orderBy('u.id','desc')
            ->paginate(7);

            return view('usuarios.usuarios.index', ["usuarios"=>$usuarios, "searchText"=>$query]);
        }
    }

    //cargamos los datos en la vista de registro
    public function create()
    {
        $empleados = DB::table('empleado')->where('status','=','1')->get();
        return view('usuarios.usuarios.create', ["empleados"=>$empleados]);
    }

    //almacenamos los registros
    public function store(UsuarioRequest $request)
    {
        $usuario = new User();
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->id_empleado=$request->get('empleado');
        $usuario->password=Hash::make($request->get('password'));
        $usuario->is_admin=($request->get('admin') == 1) ? 1 : 0;
        $usuario->save();

        return redirect('/usuarios');
    }

    //cargamos los datos en la vista de edit
    public function edit($id)
    {
        $usuario = User::find($id);
        $empleados = DB::table('empleado')->where('status','=','1')->get();
        return view('usuarios.usuarios.edit', ["usuario"=>$usuario, "empleados"=>$empleados]);
    }

    //leer usuario
    public function profile($id)
    {
        $usuario = User::find(Auth::user()->id);
        $empleados = DB::table('empleado')
        ->where('status','=','1')
        ->where('id','=',Auth::user()->id_empleado)->first();
        return view('usuarios.usuarios.profile', ["usuario"=>$usuario, "empleados"=>$empleados]);
    }

    //actualizar registros
    public function profileUserUpdate(ProfileUserRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->update();
        return redirect('/home');
    }

    //actualizar contraseña
    public function profilePasswordUpdate(PasswordUpdateRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->password=Hash::make($request->get('password'));
        $usuario->update();
        return redirect('/home');
    }
    
    //actualizar registros
    public function update(UsuarioUpdateRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->id_empleado=$request->get('empleado');
        $usuario->password=Hash::make($request->get('password'));
        $usuario->is_admin=($request->get('admin') == 1) ? 1 : 0;
        $usuario->update();
        return redirect('/usuarios');
    }

    // eliminar registros
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();
        return redirect('/usuarios');
    }
}
