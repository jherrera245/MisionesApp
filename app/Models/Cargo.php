<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    //tabla
    protected $table = 'cargo';

    //campos de la tabla cargo
    protected $fillable = [
        'id',
        'nombre',
        'status'
    ];
}
