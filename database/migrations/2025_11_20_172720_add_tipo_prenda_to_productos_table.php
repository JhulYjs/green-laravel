<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->enum('tipo_prenda', [
                'superior',     // Camisetas, blusas, polos, camisas, etc.
                'inferior',     // Pantalones, faldas, shorts, jeans, etc.
                'calzado',      // Zapatos, zapatillas, sandalias, etc.
                'accesorio',    // Bolsos, joyería, cinturones, gorros, etc.
                'abrigo',       // Chaquetas, abrigos, sudaderas, blazers
                'vestido',      // Vestidos enteros
                'otros'         // Otros tipos no categorizados
            ])->default('otros')->after('categoria_id');
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('tipo_prenda');
        });
    }
};