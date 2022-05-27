@extends('layouts.admin')
@section('contenido')

<h4>Empleados <a href="empleados/create" class="btn btn-primary">Nuevo</a></h4>

<hr>
<div class="row">
    <div class="col-lg-7 col-ms-7 col-xs-12">
        @include('empleados.empleados.search')  
    </div>
</div>
<hr>


<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardEmpleados" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardEmpleados">
        <h6 class="m-0 font-weight-bold text-primary">Empleados</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardEmpleados">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Nivel Académico</th>
                        <th>Departamento</th>
                        <th>Cargo</th>
                        <th>Teléfono</th>
                        <th>Coordinador</th>
                        <th colspan="2">Opciones</th>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                        <tr>
                            <td>{{$empleado->id}}</td>
                            <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
                            <td>{{$empleado->nivel_academico}}</td>
                            <td>{{$empleado->departamento}}</td>
                            <td>{{$empleado->cargo}}</td>
                            <td>{{$empleado->telefono}}</td>
                            @if($empleado->coordinador == 1)
                                <td>
                                    <span class="badge rounded-pill bg-success text-white">Si</span>
                                </td>
                            @else
                                <td>
                                    <span class="badge rounded-pill bg-danger text-white">No</span>
                                </td>
                            @endif
                            <td>
                                <a href="/empleados/{{$empleado->id}}/edit" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#empleado-modal-{{$empleado->id}}">Borrar</button>
                            </td>
                        </tr>
                        @include('empleados.empleados.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$empleados->render()}}
        </div>
    </div>
</div>

@endsection