@extends('layouts.admin')

@section('contenido')

<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardEstados" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardEstados">
        <h6 class="m-0 font-weight-bold text-primary">Actualización de Estados de Capacitación</h6>
    </a>

    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardEstados">
        <div class="card-body">
            <h5>Modificar Estado de Capacitación: {{$estado->nombre}}</h5>

            <form action="/estados/{{$estado->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="estado" class="form-label">Estado de Capacitación</label>
                        <input type="text" class="form-control" name="estado" id="estado" value="{{$estado->estado_capacitacion}}" maxlength="50" required>
                    </div>
                </div>

                <a href="/estados" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>

            <div class="row mt-3">
                <div class="col-12">
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
            
        </div>
    </div>
</div>
@endsection