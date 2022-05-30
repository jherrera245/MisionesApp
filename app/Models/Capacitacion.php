<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    use HasFactory;

    //tabla
    protected $table = 'capacitacion';

    //campos
    protected $fillable = [
        'id',
        'nombre_capacitacion',
        'fecha_inicio',
        'fecha_finalizacion',
        'modalidad',
        'descripcion',
        'cantidad_horas',
        'costo',
        'status'
    ];
}
