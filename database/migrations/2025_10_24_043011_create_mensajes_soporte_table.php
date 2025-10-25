<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mensajes_soporte', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('nombre_completo'); // Nombre del remitente
            $table->string('email'); // Email del remitente
            $table->text('mensaje'); // El contenido del mensaje
            $table->boolean('leido')->default(false); // Marcar si ya se leyó/atendió (opcional)
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes_soporte');
    }
};