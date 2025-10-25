<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Muestra la página de inicio.
     */
    public function showHome(): View // <-- NUEVO MÉTODO
    {
        // Por ahora, solo devuelve la vista.
        // Podrías pasarle datos si necesitaras (ej. productos destacados).
        return view('pages.home'); // Vista que crearemos
    }

    /**
     * Muestra la página "Sobre Nosotros".
     */
    public function sobreNosotros(): View
    {
        return view('pages.sobre-nosotros');
    }
}