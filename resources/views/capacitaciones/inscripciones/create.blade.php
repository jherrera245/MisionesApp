@extends('layouts.admin')

@section('contenido')

<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardInscripciones" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardInscripciones">
        <h6 class="m-0 font-weight-bold text-primary">Inscripciones en Capacitación</h6>
    </a>

    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardInscripciones">
        <div class="card-body">
            <h5>Nueva Inscripciones</h5>

            <form action="/inscripciones" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-xs-12 mb-3">
                        <label for="capacitacion" class="form-label">Capacitación</label>
                        <select class="form-control" name="capacitacion">
                            @foreach($capacitaciones as $capacitacion)
                            <option value="{{$capacitacion->id}}">{{$capacitacion->nombre_capacitacion}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4 col-xs-12 mb-3">
                        <label for="empleado" class="form-label">Empleado</label>
                        <select class="form-control" name="empleado">
                            @foreach($empleados as $empleado)
                            <option value="{{$empleado->id}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4 col-xs-12 mb-3">
                        <label for="estado" class="form-label">Estado de la capacitación</label>
                        <select class="form-control" name="estado">
                            @foreach($estados as $estado)
                            <option value="{{$estado->id}}">{{$estado->estado_capacitacion}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="inscripcion" class="form-label">Comprobante de Incripcion</label>
                        <input type="file" name="inscripcion" class="form-control">
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="finalizacion" class="form-label">Comprobante de Finalización</label>
                        <input type="file" name="finalizacion" class="form-control">
                    </div>
                </div>

                <a href="/inscripciones" class="btn btn-secondary">Cancelar</a>
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