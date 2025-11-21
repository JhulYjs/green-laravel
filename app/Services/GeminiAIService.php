<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiAIService
{
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        
        if (!$this->apiKey) {
            Log::warning('GEMINI_API_KEY no está configurada en el archivo .env');
        }
    }

    public function generateOutfits($productos, $estilo, $ocasion, $temporada, $colores = '', $preferencias = '')
    {
        if (!$this->apiKey) {
            Log::info('Usando outfits de fallback - GEMINI_API_KEY no configurada');
            return $this->generateFallbackOutfits($productos);
        }

        try {
            $productosData = $this->prepareProductosData($productos);
            $prompt = $this->buildOutfitPrompt($productosData, $estilo, $ocasion, $temporada, $colores, $preferencias);

            Log::info('Enviando solicitud a Gemini AI', [
                'productos_count' => count($productosData),
                'estilo' => $estilo,
                'ocasion' => $ocasion
            ]);

            $response = Http::timeout(30)->withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 2048,
                ]
            ]);

            if ($response->successful()) {
                Log::info('Respuesta exitosa de Gemini AI');
                return $this->parseAIResponse($response->json(), $productos);
            } else {
                Log::error('Error en respuesta de Gemini AI', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return $this->generateFallbackOutfits($productos);
            }

        } catch (\Exception $e) {
            Log::error('Error con Gemini AI: ' . $e->getMessage());
            return $this->generateFallbackOutfits($productos);
        }
    }

    private function prepareProductosData($productos)
    {
        return $productos->map(function($producto) {
            return [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'tipo_prenda' => $producto->tipo_prenda,
                'tipo_prenda_texto' => $producto->tipo_prenda_texto,
                'categoria' => 'Prenda de vestir',
                'precio' => $producto->precio_final,
                'talla' => $producto->talla,
                'estado' => $producto->estado,
                'imagen_url' => $producto->imagen_url,
                'descripcion' => $producto->descripcion,
                'colores' => $this->extraerColores($producto->nombre)
            ];
        })->toArray();
    }

    private function buildOutfitPrompt($productos, $estilo, $ocasion, $temporada, $colores, $preferencias)
    {
        return "
        Eres un estilista profesional de moda. Basándote en los productos disponibles, crea entre 3 y 5 outfits COMPLETOS y COHERENTES.

        PRODUCTOS DISPONIBLES:
        " . json_encode($productos, JSON_PRETTY_PRINT) . "

        REGLAS ESTRICTAS PARA CADA OUTFIT:
        1. CADA OUTFIT DEBE SER UNA COMBINACIÓN COMPLETA que incluya:
           - 1 prenda SUPERIOR (camiseta, blusa, polo, camisa, etc.)
           - 1 prenda INFERIOR (pantalón, falda, short, jeans, etc.) 
           - 1 CALZADO (zapatos, zapatillas, sandalias, etc.)
           - 0-1 ACCESORIOS (opcional, si hay disponibles)
           - 0-1 ABRIGOS (opcional, según temporada y ocasión)

        2. NO repitas la misma prenda en múltiples outfits
        3. Las combinaciones deben ser prácticas y usables en la vida real
        4. Considera la coherencia de estilos y colores
        5. Adapta los outfits a la temporada: {$temporada}
        6. Considera la ocasión: {$ocasion}
        7. Sigue el estilo: {$estilo}
        8. Usa los colores preferidos: {$colores}
        9. Toma en cuenta: {$preferencias}

        ESTRUCTURA OBLIGATORIA DE OUTFITS:
        - Cada outfit debe tener al menos 3 prendas (superior + inferior + calzado)
        - Puedes agregar accesorios o abrigos si son apropiados
        - Los vestidos cuentan como superior+inferior juntos

        FORMATO DE RESPUESTA ESTRICTO - SOLO JSON:
        {
            \"outfits\": [
                {
                    \"nombre\": \"Nombre creativo del outfit\",
                    \"descripcion\": \"Breve descripción de por qué funciona esta combinación\",
                    \"prendas\": [id_superior, id_inferior, id_calzado, id_accesorio(opcional), id_abrigo(opcional)]
                }
            ]
        }

        Solo devuelve el JSON, sin texto adicional. Asegúrate de que cada outfit sea coherente y usable.
        ";
    }

    private function extraerColores($nombre)
    {
        $colores = ['negro', 'blanco', 'azul', 'rojo', 'verde', 'amarillo', 'rosa', 'gris', 'marrón', 'beige', 'navy', 'crema', 'vino', 'coral', 'turquesa', 'lila', 'mostaza', 'menta'];
        $encontrados = [];
        
        foreach ($colores as $color) {
            if (stripos($nombre, $color) !== false) {
                $encontrados[] = $color;
            }
        }
        
        return $encontrados;
    }

    private function parseAIResponse($response, $productos)
    {
        try {
            $text = $response['candidates'][0]['content']['parts'][0]['text'] ?? '';
            
            // Limpiar el texto y extraer JSON
            $jsonStart = strpos($text, '{');
            $jsonEnd = strrpos($text, '}');
            
            if ($jsonStart !== false && $jsonEnd !== false) {
                $jsonString = substr($text, $jsonStart, $jsonEnd - $jsonStart + 1);
                $outfitsData = json_decode($jsonString, true);
                
                if (isset($outfitsData['outfits'])) {
                    return $this->enrichOutfitsWithProducts($outfitsData['outfits'], $productos);
                }
            }
            
            return $this->generateFallbackOutfits($productos);
            
        } catch (\Exception $e) {
            Log::error('Error parseando respuesta de IA: ' . $e->getMessage());
            return $this->generateFallbackOutfits($productos);
        }
    }

    private function enrichOutfitsWithProducts($outfits, $productos)
    {
        foreach ($outfits as &$outfit) {
            $outfit['prendas_detalles'] = [];
            foreach ($outfit['prendas'] as $productoId) {
                $producto = $productos->firstWhere('id', $productoId);
                if ($producto) {
                    $outfit['prendas_detalles'][] = $producto;
                }
            }
        }
        
        return $outfits;
    }
    
  private function generateFallbackOutfits($productos)
{
    // Mezclar las colecciones para variedad
    $superiores = $productos->filter(fn($p) => $p->esSuperior() || $p->esVestido())->shuffle();
    $inferiores = $productos->filter(fn($p) => $p->esInferior())->shuffle();
    $calzados = $productos->filter(fn($p) => $p->esCalzado())->shuffle();
    $accesorios = $productos->filter(fn($p) => $p->esAccesorio())->shuffle();
    $abrigos = $productos->filter(fn($p) => $p->esAbrigo())->shuffle();
    
    $outfits = [];
    $prendasUsadas = []; // Evitar repetir prendas
    
    // Función para obtener prenda no usada
    $getPrendaNoUsada = function($coleccion, &$usadas) {
        foreach ($coleccion as $prenda) {
            if (!in_array($prenda->id, $usadas)) {
                $usadas[] = $prenda->id;
                return $prenda;
            }
        }
        return $coleccion->first(); // Si todas usadas, repetir
    };
    
    // Outfit 1: Básico
    if ($superiores->count() > 0 && $inferiores->count() > 0 && $calzados->count() > 0) {
        $outfit1 = [
            'nombre' => 'Estilo Casual Diario',
            'descripcion' => 'Combinación perfecta para el día a día',
            'prendas_detalles' => [
                $getPrendaNoUsada($superiores, $prendasUsadas),
                $getPrendaNoUsada($inferiores, $prendasUsadas),
                $getPrendaNoUsada($calzados, $prendasUsadas)
            ]
        ];
        
        // Verificar que no haya prendas duplicadas en el outfit
        $ids = collect($outfit1['prendas_detalles'])->pluck('id')->unique();
        if ($ids->count() === 3) {
            $outfits[] = $outfit1;
        }
    }
    
    // Outfit 2: Con abrigo (si hay recursos)
    if ($superiores->count() > 1 && $inferiores->count() > 0 && $calzados->count() > 0 && $abrigos->count() > 0) {
        $outfit2 = [
            'nombre' => 'Look con Capas',
            'descripcion' => 'Ideal para días frescos con estilo',
            'prendas_detalles' => [
                $getPrendaNoUsada($superiores, $prendasUsadas),
                $inferiores->first(), // Puede repetir inferior si solo hay uno
                $calzados->first(),   // Puede repetir calzado si solo hay uno
                $getPrendaNoUsada($abrigos, $prendasUsadas)
            ]
        ];
        
        $ids = collect($outfit2['prendas_detalles'])->pluck('id')->unique();
        if ($ids->count() >= 3) { // Al menos 3 prendas únicas
            $outfits[] = $outfit2;
        }
    }
    
    // Outfit 3: Con vestido (si hay)
    $vestidos = $productos->filter(fn($p) => $p->esVestido())->shuffle();
    if ($vestidos->count() > 0 && $calzados->count() > 0) {
        $outfit3 = [
            'nombre' => 'Estilo con Vestido',
            'descripcion' => 'Elegancia y comodidad en una sola prenda',
            'prendas_detalles' => [
                $getPrendaNoUsada($vestidos, $prendasUsadas),
                $calzados->first() // Puede repetir calzado
            ]
        ];
        
        // Agregar accesorio si hay
        if ($accesorios->count() > 0) {
            $outfit3['prendas_detalles'][] = $getPrendaNoUsada($accesorios, $prendasUsadas);
        }
        
        $outfits[] = $outfit3;
    }
    
    // Outfit 4: Combinación alternativa
    if ($superiores->count() > 2 && $inferiores->count() > 0) {
        $outfit4 = [
            'nombre' => 'Combinación Fresca',
            'descripcion' => 'Nuevas prendas para tu estilo único',
            'prendas_detalles' => [
                $getPrendaNoUsada($superiores, $prendasUsadas),
                $inferiores->first(), // Puede repetir
                $calzados->first()    // Puede repetir
            ]
        ];
        
        $ids = collect($outfit4['prendas_detalles'])->pluck('id')->unique();
        if ($ids->count() >= 2) { // Al menos 2 prendas únicas
            $outfits[] = $outfit4;
        }
    }
    
    // Si no hay suficientes productos, crear outfits mínimos pero variados
    if (empty($outfits)) {
        $productosSample = $productos->shuffle()->take(min(6, $productos->count()));
        
        $outfits = [
            [
                'nombre' => 'Combinación Sostenible',
                'descripcion' => 'Prendas únicas para tu estilo personal',
                'prendas_detalles' => $productosSample->take(3)->values()
            ]
        ];
        
        // Segundo outfit si hay suficientes productos
        if ($productos->count() >= 5) {
            $outfits[] = [
                'nombre' => 'Estilo Circular',
                'descripcion' => 'Moda consciente con prendas diferentes',
                'prendas_detalles' => $productosSample->slice(3, 3)->values()
            ];
        }
    }
    
    return ['outfits' => $outfits];
}
}