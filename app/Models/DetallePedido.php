<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetallePedido extends Model
{
    use HasFactory;
    protected $table = 'detalles_pedido'; // Asegura que use la tabla correcta
    public $timestamps = false; // Esta tabla no tiene timestamps

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
    ];

    /**
     * Relación: Un detalle pertenece a un pedido.
     */
    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    /**
     * Relación: Un detalle pertenece a un producto (puede ser null si se borra).
     */
    public function producto(): BelongsTo
    {
        // Usamos 'withTrashed' si quieres poder ver detalles de productos borrados
        // o simplemente belongsTo si no es necesario.
        return $this->belongsTo(Producto::class, 'producto_id'); 
    }
}