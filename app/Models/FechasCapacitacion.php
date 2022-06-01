<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FechasCapacitacion extends Model
{
    use HasFactory;

    //nombre de la tabla 
    protected $table = 'fechas_capacitacion';

    //columnas
    protected $fillable = [
        'id',
        'id_capacitacion',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'status'
    ];
}
