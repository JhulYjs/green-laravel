<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->enum('estado_aprobacion', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->timestamp('fecha_aprobacion')->nullable();
            $table->text('motivo_rechazo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn(['estado_aprobacion', 'fecha_aprobacion', 'motivo_rechazo']);
        });
    }
};