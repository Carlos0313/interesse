<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = "event";

    protected $fillable = [
        'codigo_evento',
        'nombre',
        'detalle',
        'qty_personas',
        'qty_asistencia',
        'ubicacion',
        'fecha_lanzamiento',
        'estado',
        'es_activo'
    ];

}
