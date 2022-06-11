@extends('reportes.pdf-layout')

@section('cuerpo-pdf')

<h4 style="text-align: center">Capacitación: {{$capacitacion}}</h4>
@if($inscripcion!=null)
<h4 style="text-align: center">Inversion Total: ${{$inscripcion->total}}</h4>
<h4 style="text-align: center">Modalidad {{$inscripcion->modalidad}}</h4>
@endif
<h4>Participantes de la capacitacion: {{count($empleados)}}</h4>

<table>
    <tr>
        <th>N°</th>
        <th>Nombre Completo</th>
        <th>Estado</th>
    </tr>

    @if(count($empleados)>0)
    {{$count = 1}}
    @foreach ($empleados as $empleado)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$empleado->nombres}} {{$empleado->apellidos}}</td>
            <td>{{$empleado->estado}}</td>
        </tr>    
    @endforeach
    @else
        <tr>
            <td colspan="3" style="text-align:center">No hay reportes que mostrar</td>
        </tr>
    @endif
</table>

@endsection