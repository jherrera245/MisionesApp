@extends('reportes.pdf-layout')

@section('cuerpo-pdf')

<h4 style="text-align: center">Reporte de Inversiones por Capacitación</h4>

<table>
    <tr>
        <th>N°</th>
        <th>Capacitación</th>
        <th>Total De inscripcion</th>
    </tr>

    @if(count($inscripciones)>0)
    {{$count = 1}}
    @foreach ($inscripciones as $inscripcion)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$inscripcion->nombre_capacitacion}}</td>
            <td>$ {{$inscripcion->total}}</td>
        </tr>    
    @endforeach
    @else
        <tr>
            <td colspan="3" style="text-align:center">No hay reportes que mostrar</td>
        </tr>
    @endif
</table>

@endsection