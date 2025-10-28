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
    protected $table = 'usuarios';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_completo',
        'email',
        'password_hash',
        'rol',
    ];

    /**
     * Los atributos que deben ocultarse para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser casteados.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Método para usar nombre_completo como name (para los tests)
     */
    public function getNameAttribute()
    {
        return $this->attributes['nombre_completo'];
    }

    /**
     * Método para establecer el name (para los tests)
     */
    public function setNameAttribute($value)
    {
        $this->attributes['nombre_completo'] = $value;
    }

    /**
     * Método para obtener password como password_hash (para los tests)
     */
    public function getPasswordAttribute()
    {
        return $this->attributes['password_hash'];
    }

    /**
     * Método para usar password_hash como password (para los tests)
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password_hash'] = $value;
    }

    /**
     * Obtener la contraseña para autenticación
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    /**
     * Obtener el nombre de la columna de la contraseña.
     */
    public function getAuthPasswordName(): string
    {
        return 'password_hash';
    }

    /**
     * El nombre de la columna "created_at" del modelo.
     *
     * @var string
     */
    const CREATED_AT = 'fecha_registro';

    /**
     * El nombre de la columna "updated_at" del modelo.
     *
     * @var string
     */
    const UPDATED_AT = 'ultimo_acceso';

    /**
     * Define la relación "muchos a muchos" para el carrito.
     */
    public function carrito()
    {
        return $this->belongsToMany(Producto::class, 'carrito_usuarios', 'usuario_id', 'producto_id')
                    ->withPivot('cantidad');
    }

    /**
     * Define la relación "muchos a muchos" para los favoritos.
     */
    public function favoritos()
    {
        return $this->belongsToMany(Producto::class, 'favoritos', 'usuario_id', 'producto_id');
    }
}