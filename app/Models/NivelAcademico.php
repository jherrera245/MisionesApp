<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelAcademico extends Model
{
    use HasFactory;

    //tabla
    protected $table = 'nivel_academico';

    //campos de la tabla nivel academico
    protected $fillable = [
        'id',
        'nombre',
        'status'
    ];
}
