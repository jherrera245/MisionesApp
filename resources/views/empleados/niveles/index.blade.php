@extends('layouts.admin')
@section('contenido')

<h4>Nivel Académico <a href="nivel_academico/create" class="btn btn-primary">Nuevo</a></h4>

<hr>
<div class="row">
    <div class="col-lg-7 col-ms-7 col-xs-12">
        @include('empleados.niveles.search')  
    </div>
</div>
<hr>


<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardNiveles" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardNiveles">
        <h6 class="m-0 font-weight-bold text-primary">Nivel Académico</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardNiveles">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th class="col-2">ID</th>
                        <th class="col-8">Nivel Académico</th>
                        <th class="col-2" colspan="2">Opciones</th>
                    </thead>
                    <tbody>
                        @foreach($niveles as $nivel)
                        <tr>
                            <td>{{$nivel->id}}</td>
                            <td>{{$nivel->nombre}}</td>
                            <td>
                                <a href="/nivel_academico/{{$nivel->id}}/edit" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#nivel-modal-{{$nivel->id}}">Borrar</button>
                            </td>
                        </tr>
                        @include('empleados.niveles.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$niveles->render()}}
        </div>
    </div>
</div>

@endsection