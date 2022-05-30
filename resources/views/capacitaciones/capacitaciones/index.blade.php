@extends('layouts.admin')
@section('contenido')

<h4>Capacitaciones <a href="capacitaciones/create" class="btn btn-primary">Nuevo</a></h4>

<hr>
<div class="row">
    <div class="col-lg-7 col-ms-7 col-xs-12">
        @include('capacitaciones.capacitaciones.search')  
    </div>
</div>
<hr>

<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardCapacitaciones" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardCapacitaciones">
        <h6 class="m-0 font-weight-bold text-primary">Capacitaciones</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardCapacitaciones">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Finalización</th>
                        <th>Modalidad</th>
                        <th>Duración</th>
                        <th>Costo</th>
                        <th colspan="2">Opciones</th>
                    </thead>
                    <tbody>
                        @foreach($capacitaciones as $capacitacion)
                        <tr>
                            <td>{{$capacitacion->id}}</td>
                            <td>{{$capacitacion->nombre_capacitacion}}</td>
                            <td>{{$capacitacion->fecha_inicio}}</td>
                            <td>{{$capacitacion->fecha_finalizacion}}</td>
                            <td>{{$capacitacion->modalidad}}</td>
                            <td>{{$capacitacion->cantidad_horas}} horas</td>
                            <td>$ {{$capacitacion->costo}}</td>
                            <td>
                                <a href="/capacitaciones/{{$capacitacion->id}}/edit" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#capacitacion-modal-{{$capacitacion->id}}">Borrar</button>
                            </td>
                        </tr>
                        @include('capacitaciones.capacitaciones.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$capacitaciones->render()}}
        </div>
    </div>
</div>

@endsection