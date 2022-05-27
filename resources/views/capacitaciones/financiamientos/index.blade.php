@extends('layouts.admin')
@section('contenido')

<h4>Financiamientos <a href="financiamientos/create" class="btn btn-primary">Nuevo</a></h4>

<hr>
<div class="row">
    <div class="col-lg-7 col-ms-7 col-xs-12">
        @include('capacitaciones.financiamientos.search')  
    </div>
</div>
<hr>


<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardFinanciamientos" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardFinanciamientos">
        <h6 class="m-0 font-weight-bold text-primary">Financiamientos</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardFinanciamientos">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th class="col-2">ID</th>
                        <th class="col-8">Fuente de Financiamiento</th>
                        <th class="col-2" colspan="2">Opciones</th>
                    </thead>
                    <tbody>
                        @foreach($financiamientos as $financiamiento)
                        <tr>
                            <td>{{$financiamiento->id}}</td>
                            <td>{{$financiamiento->fuente_financiamiento}}</td>
                            <td>
                                <a href="/financiamientos/{{$financiamiento->id}}/edit" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#financiamiento-modal-{{$financiamiento->id}}">Borrar</button>
                            </td>
                        </tr>
                        @include('capacitaciones.financiamientos.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$financiamientos->render()}}
        </div>
    </div>
</div>

@endsection