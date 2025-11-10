<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- 1. ASEGÚRATE DE AÑADIR ESTA LÍNEA
use App\Models\Categoria;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 2. AÑADE ESTA LÍNEA para desactivar la revisión
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vaciar la tabla
        Producto::truncate();

        $productos = [
            // Productos originales (revisados)
            [
                'nombre' => 'Blazer Lino Orgánico Alma Verde',
                'descripcion' => 'Blazer oversize de lino orgánico teñido con pigmentos naturales. Una pieza atemporal y versátil.',
                'precio' => 129.00, 'precio_oferta' => null, 'talla' => 'M',
                'estado' => 'Como nuevo', 'imagen_url' => 'https://media.falabella.com/falabellaCL/17128233_1/w=800,h=800,fit=pad', 
                'categoria_nombre' => 'Chaquetas'
            ],
            [
                'nombre' => 'Denim Vintage Lavado Índigo',
                'descripcion' => 'Jeans rectos unisex restaurados con técnica sashiko. Un clásico reinventado.',
                'precio' => 89.00, 'precio_oferta' => 59.99, 'talla' => '32',
                'estado' => 'Buen estado', 'imagen_url' => 'uploads/products/pantalon_mezclilla_azul_clasico.png', 
                'categoria_nombre' => 'Denim'
            ],
            [
                'nombre' => 'Sudadera Reciclada Bosque Urbano',
                'descripcion' => 'Sudadera unisex fabricada con algodón y poliéster reciclado. Comodidad y sostenibilidad.',
                'precio' => 69.00, 'precio_oferta' => null, 'talla' => 'L',
                'estado' => 'Nuevo', 'imagen_url' => 'uploads/products/sudadera_reciclada_bosque_urbano.png', 
                'categoria_nombre' => 'Sudaderas'
            ],
            [
                'nombre' => 'Polo Beach Partners Niño',
                'descripcion' => 'Polo negro estampado para niño, ideal para días de verano.',
                'precio' => 25.00, 'precio_oferta' => 19.99, 'talla' => '10',
                'estado' => 'Usado', 'imagen_url' => 'uploads/products/placeholder_polo_nino.png', 
                'categoria_nombre' => 'Ropa de niños'
            ],
            [
                'nombre' => 'Abrigo Lana Gris Clásico',
                'descripcion' => 'Elegante abrigo de mezcla de lana en color gris. Perfecto para el invierno.',
                'precio' => 180.00, 'precio_oferta' => 149.99, 'talla' => 'L',
                'estado' => 'Como nuevo', 'imagen_url' => 'uploads/products/abrigo_lana_gris.png',
                'categoria_nombre' => 'Abrigos'
            ],
            [
                'nombre' => 'Camisa Lino Blanca Fresca',
                'descripcion' => 'Camisa de lino 100% natural, color blanco. Ideal para climas cálidos, muy transpirable.',
                'precio' => 75.00, 'precio_oferta' => null, 'talla' => 'M',
                'estado' => 'Nuevo', 'imagen_url' => 'uploads/products/camisa_lino_blanca.png',
                'categoria_nombre' => 'Camisas'
            ],
            [
                'nombre' => 'Camiseta Básica Blanca Algodón',
                'descripcion' => 'Camiseta básica de cuello redondo, 100% algodón orgánico. Un esencial en cualquier armario.',
                'precio' => 29.00, 'precio_oferta' => null, 'talla' => 'S',
                'estado' => 'Nuevo', 'imagen_url' => 'uploads/products/camiseta_basica_blanca.png',
                'categoria_nombre' => 'Camisetas'
            ],
            [
                'nombre' => 'Chaqueta Biker Negra Piel Sintética',
                'descripcion' => 'Chaqueta estilo biker con cremalleras y detalles metálicos. Piel sintética de alta calidad.',
                'precio' => 95.00, 'precio_oferta' => 75.00, 'talla' => 'M',
                'estado' => 'Buen estado', 'imagen_url' => 'uploads/products/chaqueta_biker_negra.png',
                'categoria_nombre' => 'Chaquetas'
            ],
            [
                'nombre' => 'Falda Plisada Verde Esmeralda Satín',
                'descripcion' => 'Falda midi plisada en un vibrante color verde esmeralda. Tejido satinado con caída elegante.',
                'precio' => 65.00, 'precio_oferta' => null, 'talla' => 'S',
                'estado' => 'Como nuevo', 'imagen_url' => 'uploads/products/falda_plisada_verde_esmeralda.png',
                'categoria_nombre' => 'Faldas'
            ],
            [
                'nombre' => 'Vestido Floral Algodón Verano',
                'descripcion' => 'Vestido ligero de algodón con estampado floral, perfecto para el verano. Corte midi y cintura ajustable.',
                'precio' => 85.00, 'precio_oferta' => 69.99, 'talla' => 'M',
                'estado' => 'Como nuevo', 'imagen_url' => 'uploads/products/vestido_floral_algodon.png',
                'categoria_nombre' => 'Vestidos'
            ],
            [
                'nombre' => 'Zapatos Oxford Marrón Piel',
                'descripcion' => 'Zapatos clásicos estilo Oxford para hombre, fabricados en piel genuina color marrón coñac.',
                'precio' => 150.00, 'precio_oferta' => null, 'talla' => '42',
                'estado' => 'Buen estado', 'imagen_url' => 'uploads/products/zapatos_oxford_marron.png',
                'categoria_nombre' => 'Zapatos'
            ],
        ]; //

        // Convertir nombres de categoría en IDs
        foreach ($productos as $producto) {
            $categoria = Categoria::where('nombre', $producto['categoria_nombre'])->first();

            Producto::create([
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'precio' => $producto['precio'],
                'precio_oferta' => $producto['precio_oferta'],
                'talla' => $producto['talla'],
                'estado' => $producto['estado'],
                'imagen_url' => $producto['imagen_url'],
                'categoria_id' => $categoria ? $categoria->id : null,
                'usuario_id' => null,
            ]);
        }
        
        // 3. AÑADE ESTA LÍNEA para reactivar la revisión
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}