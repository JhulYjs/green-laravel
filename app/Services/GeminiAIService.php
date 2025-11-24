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

        // Prompt BLINDADO para respetar las preferencias del usuario
        $prompt = "Actúa como un Asesor de Imagen Personal estricto.
        
        TU CLIENTE HA DEFINIDO ESTOS REQUISITOS (DEBES CUMPLIRLOS TODOS):
        1. **ESTILO OBLIGATORIO:** El usuario eligió estilo '$estilo'. (Ej: Si es 'Deportivo' usa zapatillas/ropa cómoda. Si es 'Elegante' prioriza tacones/vestidos/camisas. Si es 'Urbano' usa denim/streetwear).
        2. **OCASIÓN:** El outfit es para '$ocasion'. (Asegúrate de que sea apropiado para este contexto).
        3. **TEMPORADA:** Es '$temporada'. (CRÍTICO: Si es Invierno/Otoño prioriza abrigos y capas. Si es Verano/Primavera usa telas ligeras).
        4. **COLORES:** El usuario prefiere: '$colores'. (Intenta priorizar estos colores si existen en el armario).
        5. **NOTAS DEL USUARIO:** '$preferencias'. (Esta es una instrucción directa, respétala por encima de todo).

        TU MISIÓN:
        Analiza visualmente las prendas y crea 3 outfits que cumplan los requisitos anteriores usando SOLAMENTE los productos de la lista.

        REGLAS TÉCNICAS (NO ROMPER):
        1. **ZAPATOS:** Cada outfit DEBE tener calzado. (No dejes al usuario descalzo).
        2. **LÓGICA:** - Opción A: Superior + Inferior + Calzado.
           - Opción B: Vestido + Calzado.
           - PROHIBIDO: Poner pantalón/falda debajo de un vestido.
        3. **VISUAL:** Combina colores con criterio (Círculo cromático).

        FORMATO DE RESPUESTA JSON (ESTRICTO):
        {
            \"outfits\": [
                {
                    \"nombre\": \"Nombre creativo del look\",
                    \"descripcion\": \"Explica brevemente por qué este outfit encaja con el estilo $estilo y la ocasión $ocasion.\",
                    \"prendas\": [id_producto, id_producto...]
                }
            ]
        }";

        $parts[] = ['text' => $prompt];

        // Procesar productos (Texto + Imagen)
        foreach ($productos as $producto) {
            $infoTexto = "ID: {$producto->id} | Tipo: {$producto->tipo_prenda_texto} | Nombre: {$producto->nombre} | Color/Desc: {$producto->descripcion}";
            $parts[] = ['text' => $infoTexto];

            if ($producto->imagen_url) {
                // Limpieza de ruta
                $rutaLimpia = str_replace(['public/', 'storage/'], '', $producto->imagen_url);
                $rutaLimpia = ltrim($rutaLimpia, '/'); 
                
                try {
                    if (Storage::disk('public')->exists($rutaLimpia)) {
                         $fileContent = Storage::disk('public')->get($rutaLimpia);
                         $imageData = base64_encode($fileContent);
                         
                         // Detección segura de tipo de imagen
                         $extension = strtolower(pathinfo($rutaLimpia, PATHINFO_EXTENSION));
                         $mimeType = match($extension) {
                             'png' => 'image/png',
                             'webp' => 'image/webp',
                             'gif' => 'image/gif',
                             default => 'image/jpeg',
                         };
                         
                         $parts[] = [
                             'inlineData' => [
                                 'mimeType' => $mimeType,
                                 'data' => $imageData
                             ]
                         ];
                    }
                } catch (\Exception $e) {
                    Log::warning("Imagen omitida ID {$producto->id}");
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