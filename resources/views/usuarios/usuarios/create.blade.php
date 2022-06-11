@extends('layouts.admin')

@section('contenido')

<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardUsuario" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardUsuario">
        <h6 class="m-0 font-weight-bold text-primary">Registro de Usuarios</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardUsuario">
        <div class="card-body">
            <h5>Nuevo Usuario</h5>

            <form action="/usuarios" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" class="form-control" name="name" placeholder="Ingresa el username" required>
                    </div>
                    
                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Ingresa el correo del usuario" required>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Ingresa la contraseña" required>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Ingresa nuevamente la contraseña" required>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="empleado" class="form-label">Empleado</label>
                        <select class="form-control" name="empleado">
                            @foreach($empleados as $empleado)
                            <option value="{{$empleado->id}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="col-lg-6 col-xs-12 mb-3">
                    <label for="coordinador" class="form-label">Seleccionar rol</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="admin" value="1" id="admin">
                            <label class="custom-control-label" for="admin">Administrator</label>
                        </div>
                    </div>
                </div>

                <a href="/usuarios" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>

            <div class="row mt-3">
                <div class="col-12">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
