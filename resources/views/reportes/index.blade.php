@extends('layouts.admin')
@section('contenido')
<div class="card mb-4 py-3 border-left-primary">
    <div class="card-body">
        <h4>Reportes de Empleados</h4>

        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <form target="_blank" action="/reporte-empleados" method="get">
                    <div class="mb-3">
                        <label class="control-label">Ingresa el departamento</label>
                        <select class="form-control" name="departamento">
                                <option value="Todos">Todos</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{$departamento->nombre}}">{{$departamento->nombre}}</option>
                            @endforeach;
                        </select>                    
                    </div>

                    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4 py-3 border-left-primary">
    <div class="card-body">
    <h4>Reportes de Capacitaciones</h4>

    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <form target="_blank" action="/reporte-capacitaciones" method="get">
                <div class="mb-3">
                    <label class="control-label">Ingresa la capacitacion</label>
                    <select class="form-control" name="capacitacion">
                        @foreach($capacitaciones as $capacitacion)
                            <option value="{{$capacitacion->nombre_capacitacion}}">{{$capacitacion->nombre_capacitacion}}</option>
                        @endforeach;
                    </select>                    
                </div>

                <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte
                </button>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="card mb-4 py-3 border-left-primary">
    <div class="card-body">
        <h4>Reporte de total de empleados por departamento</h4>
        <a target="_blank" href="/reporte-departamentos" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte
        </a>
    </div>
</div>

<div class="card mb-4 py-3 border-left-primary">
    <div class="card-body">
        <h4>Reporte de total de inversion por capacitación</h4>
        <a target="_blank" href="/reporte-inversiones" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte
        </a>
    </div>
</div>
@endsection