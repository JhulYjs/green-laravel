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

        // Obtener productos aprobados para analizar - CORREGIDO
        $productos = Producto::aprobados()
            ->get()
            ->take(50); // Removido ->with('categoria')

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