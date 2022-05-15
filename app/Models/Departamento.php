<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    //tabla
    protected $table = 'departamento';
    
    //campos de la tabla departamento
    protected $fillable = [
        'id',
        'nombre',
        'status'
    ];
}
