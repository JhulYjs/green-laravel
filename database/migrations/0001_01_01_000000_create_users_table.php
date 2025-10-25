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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // Estándar de Laravel
            $table->string('password_hash'); // Coincide con tu nombre de columna
            $table->enum('rol', ['usuario', 'admin'])->default('usuario'); // Tu columna rol
            $table->rememberToken(); // Estándar de Laravel para "recordarme"
            $table->timestamp('fecha_registro')->useCurrent(); // Tu columna
            $table->timestamp('ultimo_acceso')->nullable(); // Tu columna
            
            // Renombramos 'created_at' y 'updated_at' por defecto
        });

        // Estas son las tablas estándar de Laravel, las dejamos
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
