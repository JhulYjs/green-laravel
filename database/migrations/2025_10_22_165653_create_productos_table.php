<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_oferta', 10, 2)->nullable();
            $table->string('talla', 50)->nullable();
            $table->enum('estado', ['Nuevo', 'Como nuevo', 'Buen estado', 'Usado']);
            $table->string('imagen_url')->nullable();

            // Clave foránea para categoria_id
            $table->foreignId('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null');

            // Clave foránea para usuario_id (referencia a la tabla 'usuarios' que creamos)
            $table->foreignId('usuario_id')->nullable();
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('set null')->onUpdate('cascade'); //

            $table->timestamp('fecha_creacion')->useCurrent();

            // Columnas generadas (exactamente como en tu instalador.php)
            $table->decimal('precio_final', 10, 2)->storedAs('COALESCE(precio_oferta, precio)');
            $table->decimal('porcentaje_descuento', 5, 2)->storedAs('CASE WHEN precio_oferta IS NOT NULL AND precio > 0 THEN ((precio - precio_oferta) / precio) * 100 ELSE 0 END');

            // Índices
            $table->index('precio_final');
            $table->index('porcentaje_descuento');
            $table->index('fecha_creacion');
            
            // Índice FULLTEXT
            $table->index(['nombre'], 'idx_nombre_productos');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
