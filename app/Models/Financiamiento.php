<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financiamiento extends Model
{
    use HasFactory;

    //tabla
    protected $table = 'financiamiento';

    //campos de la tabla de financiamiento
    protected $fillable = [
        'id',
        'fuente_financiamiento',
        'status',
    ];
}
