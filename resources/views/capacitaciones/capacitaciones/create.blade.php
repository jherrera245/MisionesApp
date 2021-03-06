@extends('layouts.admin')

@section('contenido')

<!-- Collapsable Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardCapacitaciones" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardCapacitaciones">
        <h6 class="m-0 font-weight-bold text-primary">Registro de capacitaciones</h6>
    </a>

    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardCapacitaciones">
        <div class="card-body">
            <h5>Nueva Capacitación</h5>

            <form action="/capacitaciones" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre de la capacitación" maxlength="55" required>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" name="inicio" id="inicio" required>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="fin" class="form-label">Fecha de Finalización</label>
                        <input type="date" class="form-control" name="fin" id="fin" required>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="modalidad" class="form-label">Modalidad</label>
                        <select name="modalidad" id="modalidad" class="form-control">
                            @foreach($modalidades as $modalidad)
                            <option value="{{$modalidad->id}}">{{$modalidad->modalidad}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="horas" class="form-label">Duración</label>
                        <input type="number" class="form-control" name="horas" id="horas" placeholder="Ingresa la duración en horas" min="0.00" required>
                    </div>

                    <div class="col-lg-6 col-xs-12 mb-3">
                        <label for="costo" class="form-label">Costo</label>
                        <input type="number" class="form-control" name="costo" id="costo" placeholder="Ingresa el costo por empleado" min="0.00" required>
                    </div>

                    <div class="col-lg-12 col-xs-12 mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Ingresa una breve de descripcion" maxlength="250" rows="5"></textarea>
                    </div>
                </div>

                <a href="/capacitaciones" class="btn btn-secondary">Cancelar</a>
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