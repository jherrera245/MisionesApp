@extends('layouts.admin')

@section('contenido')

<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardHorario" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardHorario">
        <h6 class="m-0 font-weight-bold text-primary">Actualización de Horarios</h6>
    </a>

    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardCargo">
        <div class="card-body">
            <h5>Modificar Horario de la fecha: {{$horario->fecha}}</h5>

            <form action="/horario_capacitacion/{{$horario->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <input class="form-control" name="capacitacion" type="hidden" value="{{$horario->id_capacitacion}}">
                    
                    <div class="col-lg-4 col-xs-12 mb-3">
                        <label for="fecha" class="form-label">Fecha de Capacitación</label>
                        <input type="date" name="fecha" class="form-control" value="{{$horario->fecha}}" required>
                    </div>
                    
                    <div class="col-lg-4 col-xs-12 mb-3">
                        <label for="entrada" class="form-label">Hora de entrada</label>
                        <input type="time" name="entrada" class="form-control" value="{{$horario->hora_inicio}}" required>
                    </div>
                    
                    <div class="col-lg-4 col-xs-12 mb-3">
                        <label for="saldia" class="form-label">Hora de entrada</label>
                        <input type="time" name="salida" class="form-control" value="{{$horario->hora_fin}}" required>
                    </div>
                </div>

                <a href="/capacitaciones/{{$horario->id_capacitacion}}" class="btn btn-secondary">Cancelar</a>
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