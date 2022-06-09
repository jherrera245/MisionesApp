@extends('layouts.admin')
@section('contenido')

<h4>Usuarios <a href="usuarios/create" class="btn btn-primary">Nuevo</a></h4>

<hr>
<div class="row">
    <div class="col-lg-7 col-ms-7 col-xs-12">
        @include('usuarios.usuarios.search')  
    </div>
</div>
<hr>


<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardUsuario" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardUsuario">
        <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardUsuario">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Empleado</th>
                            <th>Administrator</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->nombres}} {{$user->apellidos}}</td>
                            @if($user->is_admin == 1)
                                <td>
                                    <span class="badge rounded-pill bg-success text-white">Si</span>
                                </td>
                            @else
                                <td>
                                    <span class="badge rounded-pill bg-danger text-white">No</span>
                                </td>
                            @endif
                            <td>
                                <a href="/usuarios/{{$user->id}}/edit" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#user-modal-{{$user->id}}">Borrar</button>
                            </td>
                        </tr>
                        @include('usuarios.usuarios.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$usuarios->render('vendor.pagination.bootstrap-4')}}
        </div>
    </div>
</div>

@endsection