@extends('layouts.admin')
@section('contenido')

<h4>Cargos <a href="cargos/create" class="btn btn-primary">Nuevo</a></h4>

<hr>
<div class="row">
    <div class="col-lg-7 col-ms-7 col-xs-12">
        @include('empleados.cargos.search')  
    </div>
</div>
<hr>


<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardCargos" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardCargos">
        <h6 class="m-0 font-weight-bold text-primary">Cargos</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardCargos">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="col-2">ID</th>
                            <th class="col-8">Nombre</th>
                            <th class="col-2" colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cargos as $cargo)
                        <tr>
                            <td>{{$cargo->id}}</td>
                            <td>{{$cargo->nombre}}</td>
                            <td>
                                <a href="/cargos/{{$cargo->id}}/edit" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#cargo-modal-{{$cargo->id}}">Borrar</button>
                            </td>
                        </tr>
                        @include('empleados.cargos.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$cargos->render('vendor.pagination.bootstrap-4')}}
        </div>
    </div>
</div>

@endsection