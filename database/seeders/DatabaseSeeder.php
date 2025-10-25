<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamamos a nuestros seeders en orden:
        // Primero las categorías, luego los productos que dependen de ellas.
        $this->call([
            CategoriaSeeder::class,
            ProductoSeeder::class,
        ]);
    }
}
