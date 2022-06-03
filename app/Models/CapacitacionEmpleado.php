<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapacitacionEmpleado extends Model
{
    use HasFactory;

        //tabla
        protected $table = 'capacitacion_empleado';

        //campos de la tabla cargo
        protected $fillable = [
            'id',
            'comprobante_inscripcion',
            'comprobante_finalizacion',
            'id_empleado',
            'id_capacitacion',
            'id_estado_capacitacion',
            'status'
        ];
}
