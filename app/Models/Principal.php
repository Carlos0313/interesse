<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    use HasFactory;

    protected $table = "principal";

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'telefono',
        'qty_acompanantes',
        'es_activo',
    ];
}
