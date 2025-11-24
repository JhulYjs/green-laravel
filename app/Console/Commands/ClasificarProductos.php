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
        
        // 1. Vestidos (Prioridad alta para evitar que se confundan con tops)
        if (preg_match('/(vestido|vestid|dress|enterizo|mono|jumpsuit)/', $nombre)) {
            return 'vestido';
        }

        // 2. Calzado (Zapatos obligatorios)
        if (preg_match('/(zapato|zapatilla|tenis|sneaker|bota|sandalia|calzado|shoe|boot|sandal|mocasin|tacón|tacon)/', $nombre)) {
            return 'calzado';
        }
        
        // 3. Superiores
        if (preg_match('/(camiseta|blusa|polo|camisa|top|t-shirt|remera|jersey|suéter|sudadera|hoodie|chaleco|bodysuit)/', $nombre)) {
            return 'superior';
        }
        
        // 4. Inferiores
        if (preg_match('/(pantalón|pantalon|jeans|falda|short|bermuda|leggings|pantalones|skirt|vaquero)/', $nombre)) {
            return 'inferior';
        }
        
        // 5. Abrigos
        if (preg_match('/(chaqueta|abrigo|blazer|chamarra|americana|coat|jacket|parka|impermeable|gabardina|cardigan)/', $nombre)) {
            return 'abrigo';
        }
        
        // 6. Accesorios (SIN JOYAS - Solo funcionales como sombreros, bufandas, bolsos)
        // Hemos quitado: joya, collar, arete, anillo, pulsera
        if (preg_match('/(bolso|mochila|cartera|gorro|sombrero|bufanda|guante|cinturón|cinturon|lentes|gafas|bag|hat|scarf|belt|cap)/', $nombre)) {
            return 'accesorio';
        }
        
        return 'otros'; // Las joyas caerán aquí y serán ignoradas por el generador
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