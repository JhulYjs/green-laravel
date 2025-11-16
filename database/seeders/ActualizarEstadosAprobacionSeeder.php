<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ActualizarEstadosAprobacionSeeder extends Seeder
{
    public function run(): void
    {
        Producto::whereNull('estado_aprobacion')->update([
            'estado_aprobacion' => 'aprobado',
            'fecha_aprobacion' => now()
        ]);
        
        $this->command->info('Estados de aprobación actualizados para productos existentes.');
    }
}