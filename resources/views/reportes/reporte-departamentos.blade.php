@extends('reportes.pdf-layout')

@section('cuerpo-pdf')

<h4 style="text-align: center">Reporte de Departamentos</h4>

<table>
    <tr>
        <th>N°</th>
        <th>Departamento</th>
        <th>Total Empleados</th>
    </tr>

    @if(count($departamentos)>0)
    {{$count = 1}}
    @foreach ($departamentos as $departamento)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$departamento->nombre}}</td>
            <td>{{$departamento->total}}</td>
        </tr>    
    @endforeach
    @else
        <tr>
            <td colspan="3" style="text-align:center">No hay reportes que mostrar</td>
        </tr>
    @endif
</table>

@endsection