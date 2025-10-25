<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'usuarios'; // 1. Usar tu tabla

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_completo', // 2. Tu columna de nombre
        'email',
        'password_hash', // 3. Tu columna de password
        'rol',             // 4. Tu columna de rol
    ];

    /**
     * Los atributos que deben ocultarse para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_hash', // Ocultar el hash
        'remember_token',
    ];

    /**
     * Obtener el nombre de la columna de la contraseña.
     */
    public function getAuthPasswordName(): string
    {
        return 'password_hash'; // 5. Decirle a Laravel cómo se llama tu columna
    }

    /**
     * Los atributos que deben ser casteados.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // No casteamos el password, ya que usamos un nombre personalizado
    ];
    
    /**
     * El nombre de la columna "created_at" del modelo.
     *
     * @var string
     */
    const CREATED_AT = 'fecha_registro'; // 6. Tu columna de creación

    /**
     * El nombre de la columna "updated_at" del modelo.
     *
     * @var string
     */
    const UPDATED_AT = 'ultimo_acceso'; // 7. Tu columna de actualización
    /**
 * Define la relación "muchos a muchos" para el carrito.
 */
    public function carrito()
    {
        return $this->belongsToMany(Producto::class, 'carrito_usuarios', 'usuario_id', 'producto_id')
                    ->withPivot('cantidad'); // Keep this line we added earlier
                    // REMOVED ->withTimestamps('fecha_agregado', null);
    }

    /**
     * Define la relación "muchos a muchos" para los favoritos.
     * Reemplaza getFavoritosIds
     */
    public function favoritos()
    {
        // Un usuario tiene y pertenece a muchos Productos
        // a través de la tabla 'favoritos'
        // No necesitamos timestamps aquí
        return $this->belongsToMany(Producto::class, 'favoritos', 'usuario_id', 'producto_id');
    }
}