<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait HasFactory
use Illuminate\Database\Eloquent\Model; // Importa la clase base Model
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503

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