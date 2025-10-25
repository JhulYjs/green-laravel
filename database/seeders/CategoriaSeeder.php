<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Importar la clase DB
use App\Models\Categoria; // Importar el modelo

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Desactivar chequeo de claves foráneas temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Vaciar la tabla para evitar duplicados si se corre varias veces
        Categoria::truncate();

        $categorias = [
            'Vestidos', 'Denim', 'Sudaderas', 'Ropa de niños',
            'Abrigos', 'Camisas', 'Camisetas', 'Chaquetas', 'Faldas', 'Zapatos'
        ]; //

        foreach ($categorias as $categoria) {
            Categoria::create([
                'nombre' => $categoria
            ]);
        }
        
        // Reactivar chequeo de claves
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}