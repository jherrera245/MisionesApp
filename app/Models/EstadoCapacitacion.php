<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCapacitacion extends Model
{
    use HasFactory;   
    
    //tabla
    protected $table = 'estado_capacitacion';
    
    //campos de la tabla departamento
    protected $fillable = [
        'id',
        'estado_capacitacion',
        'status'
    ];
}
