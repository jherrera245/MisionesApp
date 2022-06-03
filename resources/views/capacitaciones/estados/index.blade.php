@extends('layouts.admin')
@section('contenido')

<h4>Estado de Capacitación <a href="estados/create" class="btn btn-primary">Nuevo</a></h4>

<hr>
<div class="row">
    <div class="col-lg-7 col-ms-7 col-xs-12">
        @include('capacitaciones.estados.search')  
    </div>
</div>
<hr>


<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardEstados" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardEstados">
        <h6 class="m-0 font-weight-bold text-primary">Financiamientos</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardEstados">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="col-2">ID</th>
                            <th class="col-8">Fuente de Financiamiento</th>
                            <th class="col-2" colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estados as $estado)
                        <tr>
                            <td>{{$estado->id}}</td>
                            <td>{{$estado->estado_capacitacion}}</td>
                            <td>
                                <a href="/estados/{{$estado->id}}/edit" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#estado-modal-{{$estado->id}}">Borrar</button>
                            </td>
                        </tr>
                        @include('capacitaciones.estados.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$estados->render('vendor.pagination.bootstrap-4')}}
        </div>
    </div>
</div>

@endsection