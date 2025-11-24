<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Services\GeminiAIService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class OutfitGeneratorController extends Controller
{
    protected $geminiService;

    public function __construct()
    {
        $this->geminiService = new GeminiAIService();
    }

    public function showGenerator()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para usar el generador de outfits.');
        }

        return view('outfits.generator');
    }

    public function generateOutfits(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para generar outfits.');
        }

        $request->validate([
            'estilo' => 'required|string',
            'ocasion' => 'required|string', 
            'temporada' => 'required|string',
            'colores' => 'nullable|string',
            'preferencias' => 'nullable|string'
        ]);

        // ============================================================
        // 🎲 ESTRATEGIA DE VARIEDAD Y BALANCE (NUEVO CÓDIGO)
        // ============================================================
        
        // 1. Definimos cantidades para asegurar un mix completo
        // Usamos 'inRandomOrder()' para que cada vez sean productos DISTINTOS
        
        $superiores = Producto::aprobados()->where('tipo_prenda', 'superior')->inRandomOrder()->take(12)->get();
        $inferiores = Producto::aprobados()->where('tipo_prenda', 'inferior')->inRandomOrder()->take(12)->get();
        $vestidos   = Producto::aprobados()->where('tipo_prenda', 'vestido')->inRandomOrder()->take(6)->get();
        
        // ¡CRUCIAL! Forzamos traer zapatos y abrigos suficientes
        $zapatos    = Producto::aprobados()->where('tipo_prenda', 'calzado')->inRandomOrder()->take(8)->get();
        $abrigos    = Producto::aprobados()->where('tipo_prenda', 'abrigo')->inRandomOrder()->take(6)->get();
        $accesorios = Producto::aprobados()->where('tipo_prenda', 'accesorio')->inRandomOrder()->take(6)->get();

        // 2. Mezclamos todo en una sola bolsa para la IA
        $productos = $superiores
            ->merge($inferiores)
            ->merge($vestidos)
            ->merge($zapatos)
            ->merge($abrigos)
            ->merge($accesorios);

        // RESPALDO: Si la tienda tiene muy poca ropa, rellenamos al azar
        if ($productos->count() < 15) {
            $productos = Producto::aprobados()->inRandomOrder()->take(40)->get();
        }
        
        // ============================================================

        // Generar outfits con Gemini AI
        $outfits = $this->geminiService->generateOutfits(
            $productos,
            $request->estilo,
            $request->ocasion, 
            $request->temporada,
            $request->colores,
            $request->preferencias
        );

        // Guardar en cache por 10 minutos
        $cacheKey = 'outfits_' . Auth::id();
        Cache::put($cacheKey, $outfits, 600);

        return redirect()->route('outfits.results');
    }

    public function showResults()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus outfits.');
        }

        $cacheKey = 'outfits_' . Auth::id();
        $outfits = Cache::get($cacheKey, []);

        return view('outfits.results', compact('outfits'));
    }
}