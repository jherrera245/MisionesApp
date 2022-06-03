@extends('layouts.admin')
@section('contenido')

<h4>Inscripcion en Capacitación <a href="inscripciones/create" class="btn btn-primary">Nuevo</a></h4>

<hr>
<div class="row">
    <div class="col-lg-7 col-ms-7 col-xs-12">
        @include('capacitaciones.inscripciones.search')  
    </div>
</div>
<hr>


<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardInscripciones" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardInscripciones">
        <h6 class="m-0 font-weight-bold text-primary">Inscripciones</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardInscripciones">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Comprobante de Inscripcion</th>
                            <th>Comprobante de Finalización</th>
                            <th>Empleado</th>
                            <th>Capacitación</th>
                            <th>Estado</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inscripciones as $inscripcion)
                        <tr>
                            <td>{{$inscripcion->id}}</td>
                            <td>
                                @if($inscripcion->comprobante_inscripcion == '')
                                <a target="_blank" class="btn btn-success btn-block disabled">Obtener Comprobante</a>
                                @else
                                <a target="_blank" class="btn btn-success btn-block" href="/documentos/{{$inscripcion->comprobante_inscripcion}}">Obtener Comprobante</a>
                                @endif
                            </td>
                            <td>
                                @if($inscripcion->comprobante_finalizacion == '')
                                <a target="_blank" class="btn btn-success btn-block disabled">Obtener Comprobante</a>
                                @else
                                <a target="_blank" class="btn btn-success btn-block" href="/documentos/{{$inscripcion->comprobante_finalizacion}}">Obtener Comprobante</a>
                                @endif
                            </td>
                            <td>{{$inscripcion->nombres}} {{$inscripcion->apellidos}}</td>
                            <td>{{$inscripcion->nombre_capacitacion}}</td>
                            <td>{{$inscripcion->estado_capacitacion}}</td>
                            <td>
                                <a href="/inscripciones/{{$inscripcion->id}}/edit" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#inscripcion-modal-{{$inscripcion->id}}">Borrar</button>
                            </td>
                        </tr>
                        @include('capacitaciones.inscripciones.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$inscripciones->render('vendor.pagination.bootstrap-4')}}
        </div>
    </div>
</div>

@endsection