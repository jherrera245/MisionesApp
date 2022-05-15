@extends('layouts.admin')

@section('contenido')

<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardCargo" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardCargo">
        <h6 class="m-0 font-weight-bold texCargot-primary">Actualización de cargos</h6>
    </a>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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

    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardCargo">
        <div class="card-body">
            <h5>Modificar Cargo: {{$cargo->nombre}}</h5>

            <form action="/cargos/{{$cargo->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{$cargo->nombre}}" maxlength="70" required>
                    </div>
                </div>

                <a href="/cargos" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
@endsection