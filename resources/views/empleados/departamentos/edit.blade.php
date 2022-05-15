@extends('layouts.admin')

@section('contenido')

<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardDepartamento" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardDepartamento">
        <h6 class="m-0 font-weight-bold text-primary">Actualización de departamentos</h6>
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
    <div class="collapse show" id="collapseCardDepartamento">
        <div class="card-body">
            <h5>Modificar departamento: {{$departamento->nombre}}</h5>

            <form action="/departamentos/{{$departamento->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{$departamento->nombre}}" maxlength="70" required>
                    </div>
                </div>

                <a href="/departamentos" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
@endsection