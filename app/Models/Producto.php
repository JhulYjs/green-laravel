<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productos';

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = null;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'precio_oferta',
        'talla',
        'estado',
        'imagen_url',
        'categoria_id',
        'usuario_id',
        'estado_aprobacion',
        'fecha_aprobacion',
        'motivo_rechazo',
    ];

    /**
     * Define the relationship inverse: A product belongs to a user (seller).
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [                         // <-- ADD THIS PROPERTY
        'fecha_creacion' => 'datetime',       // <-- Tell Laravel this is a date/time
        'precio' => 'decimal:2',              // Optional: Cast prices too for consistency
        'precio_oferta' => 'decimal:2',       // Optional: Cast prices too for consistency
        'precio_final' => 'decimal:2',        // Optional: Cast prices too for consistency
    ];                                           // <-- END ADDITION

    //MÉTODOS NUEVOS
    public function estaPendiente(): bool
    {
        return $this->estado_aprobacion === 'pendiente';
    }

    public function estaAprobado(): bool
    {
        return $this->estado_aprobacion === 'aprobado';
    }

    public function estaRechazado(): bool
    {
        return $this->estado_aprobacion === 'rechazado';
    }

    public function scopeAprobados($query)
    {
        return $query->where('estado_aprobacion', 'aprobado');
    }

    public function scopePendientes($query)
    {
        return $query->where('estado_aprobacion', 'pendiente');
    }

    public function scopeRechazados($query)
    {
        return $query->where('estado_aprobacion', 'rechazado');
    }

    public function scopeRecientesAprobados($query, $dias = 7)
    {
        return $query->aprobados()
                    ->where('fecha_aprobacion', '>=', now()->subDays($dias));
    }
}