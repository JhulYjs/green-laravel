<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos'; // Asegura que use la tabla correcta

    // Especifica los nombres de las columnas de timestamp
    const CREATED_AT = 'fecha_pedido';
    const UPDATED_AT = null; // No usamos updated_at en esta tabla

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'usuario_id',
        'total',
        'direccion_envio',
        'estado',
        // 'fecha_pedido' se maneja automáticamente
    ];

    /**
     * Relación: Un pedido pertenece a un usuario.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Relación: Un pedido tiene muchos detalles.
     */
    public function detalles(): HasMany
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }
}