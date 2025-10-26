<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensajeSoporte extends Model
{
    use HasFactory;

    // Nombre de la tabla (Laravel lo infiere, pero es bueno ser explícito)
    protected $table = 'mensajes_soporte'; 

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_completo',
        'email',
        'mensaje',
        'leido', // Si quieres poder cambiar esto masivamente
    ];

    // Opcional: Cast para el campo 'leido'
    protected $casts = [
        'leido' => 'boolean',
    ];
}