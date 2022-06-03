@extends('layouts.admin')
@section('contenido')

<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardCapacitaciones" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardCapacitaciones">
        <h6 class="m-0 font-weight-bold text-primary">Capacitacion: {{$capacitacion->nombre_capacitacion}}</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardCapacitaciones">
        <div class="card-body">
        <h4>{{$capacitacion->nombre_capacitacion}}</h4>
            <div class="table-responsive">
                <table class="table table-warning table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha de inicio</th>
                            <th>Fecha de finalización</th>
                            <th>Costo por Empleado</th>
                            <th>Modalidad</th>
                            <th>Duración</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$capacitacion->fecha_inicio}}</td>
                            <td>{{$capacitacion->fecha_finalizacion}}</td>
                            <td>$ {{$capacitacion->costo}}</td>
                            <td>{{$capacitacion->modalidad}}</td>
                            <td>{{$capacitacion->cantidad_horas}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card mb-4 py-3 border-left-primary">
                <div class="card-body">
                    <h5>Descripción</h5>
                    <p>{{$capacitacion->descripcion}}</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardFinanciamientos" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardFinanciamientos">
        <h6 class="m-0 font-weight-bold text-primary">Financiamientos de la capacitacion: {{$capacitacion->nombre_capacitacion}}</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardFinanciamientos">
        <div class="card-body">
            @if(count($financiamiento_capacitacion)>0)
            <div class="row">
            @foreach($financiamiento_capacitacion as $financiamiento)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 p-2">
                    <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#financiamiento-remove-modal-{{$financiamiento->id}}">
                        {{$financiamiento->fuente_financiamiento}}
                    </button>
                </div>
                @include('capacitaciones.capacitaciones.remove-modal-financiamiento')
            @endforeach
            </div>
            @else
            <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                    <h5>No existen financiamientos asignados actual mente</h5>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="card-footer">
        <button class="btn btn-primary" data-toggle="modal" data-target="#financiamiento-add-modal">Agregar</button>
    </div>
    @include('capacitaciones.capacitaciones.add-modal-financiamiento')
</div>


<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardHorarios" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardHorarios">
        <h6 class="m-0 font-weight-bold text-primary">Horarios: {{$capacitacion->nombre_capacitacion}}</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardHorarios">
        <div class="card-body">
            @if(count($horarios)>0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="col-2">Fecha</th>
                            <th class="col-4">Hora de inicio</th>
                            <th class="col-4">Hora de finalización</th>
                            <th class="col-2" colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($horarios as $horario)
                        <tr>
                            <td>{{$horario->fecha}}</td>
                            <td>{{$horario->hora_inicio}}</td>
                            <td>{{$horario->hora_fin}}</td>
                            <td>
                                <a href="/horario_capacitacion/{{$horario->id}}/edit" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#horario-remove-modal-{{$horario->id}}">Borrar</button>
                            </td>
                        </tr>
                        @include('capacitaciones.capacitaciones.remove-modal-horario')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$horarios->render('vendor.pagination.bootstrap-4')}}
            @else
            <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                    <h5>No existen horarios asignados actual mente</h5>
                </div>
            </div>
            @endif
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" data-toggle="modal" data-target="#horario-add-modal">Agregar</button>
        </div>

        @include('capacitaciones.capacitaciones.add-modal-horario')
    </div>
</div>

@endsection