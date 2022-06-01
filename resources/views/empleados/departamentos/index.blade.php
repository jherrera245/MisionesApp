@extends('layouts.admin')
@section('contenido')

<h4>Departamentos <a href="departamentos/create" class="btn btn-primary">Nuevo</a></h4>

<hr>
<div class="row">
    <div class="col-lg-7 col-ms-7 col-xs-12">
        @include('empleados.departamentos.search')  
    </div>
</div>
<hr>


<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardDepartamentos" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardDepartamentos">
        <h6 class="m-0 font-weight-bold text-primary">Departamentos</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardDepartamentos">
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
                        @foreach($departamentos as $departamento)
                        <tr>
                            <td>{{$departamento->id}}</td>
                            <td>{{$departamento->nombre}}</td>
                            <td>
                                <a href="/departamentos/{{$departamento->id}}/edit" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#departamento-modal-{{$departamento->id}}">Borrar</button>
                            </td>
                        </tr>
                        @include('empleados.departamentos.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$departamentos->render('vendor.pagination.bootstrap-4')}}
        </div>
    </div>
</div>

@endsection