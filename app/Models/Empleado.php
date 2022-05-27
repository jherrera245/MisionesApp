<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    //nombre de la tabla
    protected $table = 'empleado';

    //campos
    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'dui',
        'id_nivel_academico',
        'id_departamento',
        'id_cargo',
        'telefono',
        'coordinador',
        'status'
    ];
}
