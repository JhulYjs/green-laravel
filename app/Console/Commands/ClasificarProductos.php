<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Producto;

class ClasificarProductos extends Command
{
    protected $signature = 'productos:clasificar';
    protected $description = 'Clasifica automáticamente los productos por tipo de prenda';

    public function handle()
    {
        $this->info('Iniciando clasificación de productos...');
        
        $productos = Producto::all();
        $clasificados = 0;
        
        $this->output->progressStart($productos->count());

        foreach ($productos as $producto) {
            $tipoPrenda = $this->determinarTipoPrenda($producto->nombre);
            $producto->tipo_prenda = $tipoPrenda;
            $producto->save();
            
            $clasificados++;
            $this->output->progressAdvance();
        }
        
        $this->output->progressFinish();
        $this->info("✅ Clasificación completada: {$clasificados} productos clasificados");
        
        // Mostrar resumen
        $this->mostrarResumenClasificacion();
    }
    
    private function determinarTipoPrenda($nombre)
    {
        $nombre = strtolower($nombre);
        
        // Superiores
        if (preg_match('/(camiseta|blusa|polo|camisa|top|t-shirt|remera|jersey|suéter|sudadera|hoodie)/', $nombre)) {
            return 'superior';
        }
        
        // Inferiores
        if (preg_match('/(pantalón|pantalon|jeans|falda|short|bermuda|leggings|pantalones)/', $nombre)) {
            return 'inferior';
        }
        
        // Calzado
        if (preg_match('/(zapato|zapatilla|tenis|sneaker|bota|sandalia|calzado|shoe)/', $nombre)) {
            return 'calzado';
        }
        
        // Accesorios
        if (preg_match('/(bolso|mochila|cartera|gorro|sombrero|bufanda|guante|cinturón|cinturon|joya|collares|arete|accesorio)/', $nombre)) {
            return 'accesorio';
        }
        
        // Abrigos
        if (preg_match('/(chaqueta|abrigo|blazer|chamarra|americana|coat|jacket|parka|impermeable)/', $nombre)) {
            return 'abrigo';
        }
        
        // Vestidos
        if (preg_match('/(vestido|vestid|dress)/', $nombre)) {
            return 'vestido';
        }
        
        return 'otros';
    }
    
    private function mostrarResumenClasificacion()
    {
        $resumen = Producto::selectRaw('tipo_prenda, COUNT(*) as total')
            ->groupBy('tipo_prenda')
            ->get();
            
        $this->info("\n📊 Resumen de clasificación:");
        $this->table(['Tipo de Prenda', 'Total'], $resumen->map(function($item) {
            return [
                'tipo_prenda' => $item->tipo_prenda,
                'total' => $item->total
            ];
        }));
    }
}