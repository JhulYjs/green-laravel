<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GeminiAIService
{
    protected $apiKey;
    // CAMBIO IMPORTANTE: Usamos gemini-1.5-flash para capacidad multimodal (texto + imagen)
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent';
    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        if (!$this->apiKey) {
            Log::warning('GEMINI_API_KEY no está configurada.');
        }
    }

    public function generateOutfits($productos, $estilo, $ocasion, $temporada, $colores = '', $preferencias = '')
    {
        if (!$this->apiKey) {
            return $this->generateFallbackOutfits($productos);
        }

        try {
            // Preparamos los datos incluyendo IMÁGENES en Base64
            $contents = $this->prepareMultimodalData($productos, $estilo, $ocasion, $temporada, $colores, $preferencias);

            Log::info('Enviando solicitud a Gemini Vision AI', ['items_count' => $productos->count()]);

            $response = Http::timeout(60)->withHeaders([ // Aumentamos timeout para imágenes
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '?key=' . $this->apiKey, [
                'contents' => $contents,
                'generationConfig' => [
                    'temperature' => 0.5, // Más bajo para ser más estricto con las reglas
                    'topK' => 30,
                    'topP' => 0.90,
                    'maxOutputTokens' => 4096,
                    'responseMimeType' => 'application/json' // Forzar respuesta JSON
                ]
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                return $this->parseAIResponse($responseData, $productos);
            } else {
                Log::error('Gemini Error: ' . $response->body());
                return $this->generateFallbackOutfits($productos);
            }

        } catch (\Exception $e) {
            Log::error('Gemini Exception: ' . $e->getMessage());
            return $this->generateFallbackOutfits($productos);
        }
    }

private function prepareMultimodalData($productos, $estilo, $ocasion, $temporada, $colores, $preferencias)
    {
        $parts = [];

        // Prompt del Estilista
        $prompt = "Actúa como un consultor de imagen de alta costura y experto en teoría del color.
        
        TU MISIÓN:
        Crear 3 outfits visualmente impactantes y coherentes usando SOLAMENTE los productos proporcionados.
        
        CONTEXTO DEL CLIENTE:
        - Estilo deseado: $estilo
        - Ocasión: $ocasion
        - Temporada (Clima): $temporada
        - Colores preferidos: $colores
        - Notas extra: $preferencias

        REGLAS DE ESTILO INQUEBRANTABLES:
        1. **COHERENCIA CLIMÁTICA:** Respeta el clima (Invierno=Abrigo, Verano=Ligero).
        2. **ARMONÍA VISUAL:** Combina colores usando teoría del color (complementarios, análogos).
        3. **ESTRUCTURA:**
           - Opción A: Superior + Inferior + Calzado.
           - Opción B: Vestido + Calzado.
           - PROHIBIDO: Falda/Pantalón debajo de vestido.
        4. **ZAPATOS:** El calzado es obligatorio y debe combinar.

        FORMATO DE RESPUESTA JSON (ESTRICTO):
        {
            \"outfits\": [
                {
                    \"nombre\": \"Nombre creativo\",
                    \"descripcion\": \"Explicación corta de estilo.\",
                    \"prendas\": [id_producto, id_producto...]
                }
            ]
        }";

        $parts[] = ['text' => $prompt];

        // Procesar productos
        foreach ($productos as $producto) {
            // Info de texto
            $infoTexto = "ID: {$producto->id} | Prenda: {$producto->tipo_prenda_texto} | Nombre: {$producto->nombre} | Color: {$producto->descripcion}";
            $parts[] = ['text' => $infoTexto];

            // Info de imagen (CON CORRECCIÓN DE ERROR)
            if ($producto->imagen_url) {
                // 1. Limpieza de ruta
                $rutaLimpia = str_replace(['public/', 'storage/'], '', $producto->imagen_url);
                $rutaLimpia = ltrim($rutaLimpia, '/'); // Quitar barra inicial si existe
                
                try {
                    // 2. Verificar existencia en disco 'public'
                    if (Storage::disk('public')->exists($rutaLimpia)) {
                         
                         // Leer el archivo
                         $fileContent = Storage::disk('public')->get($rutaLimpia);
                         $imageData = base64_encode($fileContent);
                         
                         // CORRECCIÓN: Determinar MimeType por extensión (Más seguro que Storage::mimeType)
                         $extension = strtolower(pathinfo($rutaLimpia, PATHINFO_EXTENSION));
                         $mimeType = match($extension) {
                             'png' => 'image/png',
                             'webp' => 'image/webp',
                             'gif' => 'image/gif',
                             default => 'image/jpeg', // jpg, jpeg y otros caen aquí
                         };
                         
                         $parts[] = [
                             'inlineData' => [
                                 'mimeType' => $mimeType,
                                 'data' => $imageData
                             ]
                         ];
                    }
                } catch (\Exception $e) {
                    // Si falla una imagen, la ignoramos y seguimos con el texto
                    // Esto evita que todo el generador se rompa por una foto mala
                    Log::warning("Imagen omitida ID {$producto->id}: " . $e->getMessage());
                }
            }
        }

        return [['parts' => $parts]];
    }

    private function parseAIResponse($data, $productos)
    {
        try {
            $jsonText = $data['candidates'][0]['content']['parts'][0]['text'];
            $outfitsData = json_decode($jsonText, true);

            if (isset($outfitsData['outfits'])) {
                return $this->enrichOutfitsWithProducts($outfitsData['outfits'], $productos);
            }
        } catch (\Exception $e) {
            Log::error('Error parseando JSON de Gemini: ' . $e->getMessage());
        }
        return $this->generateFallbackOutfits($productos);
    }

    private function enrichOutfitsWithProducts($outfits, $productos)
    {
        foreach ($outfits as &$outfit) {
            $outfit['prendas_detalles'] = [];
            foreach ($outfit['prendas'] as $id) {
                $prod = $productos->firstWhere('id', $id);
                if ($prod) $outfit['prendas_detalles'][] = $prod;
            }
        }
        return $outfits;
    }

    // FALLBACK MEJORADO (LÓGICA MANUAL)
    private function generateFallbackOutfits($productos)
    {
        $outfits = [];
        $calzados = $productos->filter->esCalzado();
        $vestidos = $productos->filter->esVestido();
        $superiores = $productos->filter->esSuperior();
        $inferiores = $productos->filter->esInferior();
        $accesorios = $productos->filter->esAccesorio(); // Ya no incluye joyas por el cambio en el Regex

        // Si no hay zapatos, es difícil hacer un outfit completo, pero lo intentamos
        if ($calzados->isEmpty()) return ['outfits' => []];

        // Outfit 1: Vestido (Si hay)
        if ($vestidos->isNotEmpty()) {
            $outfits[] = [
                'nombre' => 'Look de una pieza',
                'descripcion' => 'Opción elegante y sencilla.',
                'prendas_detalles' => [
                    $vestidos->random(),
                    $calzados->random(),
                    $accesorios->isNotEmpty() ? $accesorios->random() : null
                ]
            ];
        }

        // Outfit 2 y 3: Dos piezas
        if ($superiores->isNotEmpty() && $inferiores->isNotEmpty()) {
            for ($i = 0; $i < 2; $i++) {
                $outfits[] = [
                    'nombre' => 'Combinación Casual ' . ($i + 1),
                    'descripcion' => 'Conjunto versátil de dos piezas.',
                    'prendas_detalles' => [
                        $superiores->random(),
                        $inferiores->random(),
                        $calzados->random(),
                        ($accesorios->count() > 1) ? $accesorios->random() : null
                    ]
                ];
            }
        }

        // Limpiar nulos
        foreach ($outfits as &$outfit) {
            $outfit['prendas_detalles'] = array_filter($outfit['prendas_detalles']);
        }

        return ['outfits' => $outfits];
    }
}