<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencia';

    protected $fillable = [
        "evento_id",
        "titular_id",
        "acompanante_id",
        "asiste",
        "es_activo"
    ];
}
