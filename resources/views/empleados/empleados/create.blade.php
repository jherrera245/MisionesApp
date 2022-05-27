@extends('layouts.admin')

@section('contenido')

<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardEmpleado" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardEmpleado">
        <h6 class="m-0 font-weight-bold text-primary">Registro de Empleados</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardEmpleado">
        <div class="card-body">
            <h5>Nuevo Empleado</h5>

            <form action="/empleados" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingresa el nombre del empleado" maxlength="75" required>
                    </div>
                    
                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Ingresa el apellido del empleado" maxlength="75" required>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="uid" class="form-label">DUI</label>
                        <input type="text" class="form-control" name="dui" id="dui" pattern="[0-9]{8}-[0-9]{1}" placeholder="Ingresa el numero de dui 00000000-0" maxlength="75" required>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="nivel" class="form-label">Nivel Académico</label>
                        <select class="form-control" id="nivel" name="nivel">
                            @foreach($niveles as $nivel)
                            <option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" pattern="[0-9]{4}-[0-9]{4}" placeholder="Ingresa el teléfono 0000-0000" maxlength="9" required>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select class="form-control" id="departamento" name="departamento">
                            @foreach($departamentos as $departamento)
                            <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                    <label for="coordinador" class="form-label">Seleccionar si es coordinador</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="coordinador" value="1" id="coordinador">
                            <label class="custom-control-label" for="coordinador">Coordinador</label>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <select class="form-control" id="cargo" name="cargo">
                            @foreach($cargos as $cargo)
                            <option value="{{$cargo->id}}">{{$cargo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <a href="/empleados" class="btn btn-secondary">Cancelar</a>
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
