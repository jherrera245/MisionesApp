@extends('reportes.pdf-layout')

@section('cuerpo-pdf')

<h4 style="text-align: center">Departamento: {{$departamento}}</h4>

<h4>Reporte de Empleados</h4>

<table>
    <tr>
        <th>N°</th>
        <th>Nombre Completo</th>
        <th>Departamento</th>
        <th>Cargo</th>
        <th>Capacitaciones</th>
    </tr>

    @if(count($empleados)>0)
    {{$count = 1}}
    @foreach ($empleados as $empleado)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
            <td>{{$empleado->departamento}}</td>
            <td>{{$empleado->cargo}}</td>
            <td>{{$empleado->total}}</td>
        </tr>    
    @endforeach
    @else
        <tr>
            <td colspan="5" style="text-align:center">No hay reportes que mostrar</td>
        </tr>
    @endif
</table>

@endsection