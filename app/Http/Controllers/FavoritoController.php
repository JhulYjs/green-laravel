<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    /**
     * Muestra la página de favoritos del usuario.
     * Reemplaza mostrarFavoritos
     */
    public function index()
    {
        $user = Auth::user();
        // Cargamos los productos favoritos usando la relación
        $productosFavoritos = $user->favoritos()->get(); // Eloquent obtiene los productos directamente

        // Pasamos los productos a la vista
        return view('favoritos.index', [
            'productosFavoritos' => $productosFavoritos
        ]);
    }

    /**
     * Alterna el estado de favorito de un producto para el usuario.
     * Reemplaza manejar y toggleFavorito
     */
    public function toggle(Request $request, Producto $producto)
    {
        $user = Auth::user();

        // 'toggle' añade si no existe, quita si ya existe.
        // Devuelve un array con ['attached' => [...], 'detached' => [...]]
        $result = $user->favoritos()->toggle([$producto->id]);

        $action = !empty($result['attached']) ? 'added' : 'removed';

        // Devolvemos una respuesta JSON, igual que antes
        return response()->json(['status' => 'success', 'action' => $action]);
    }

    /**
     * Obtiene solo los IDs de los productos favoritos (para el frontend).
     * Reemplaza getFavoritosIds
     */
     public function getIds()
     {
         $user = Auth::user();
         // 'pluck' obtiene solo la columna 'id' de los productos relacionados
         $favoritoIds = $user->favoritos()->pluck('productos.id'); // Asegúrate de especificar la tabla 'productos'

         return response()->json(['status' => 'success', 'favoritoIds' => $favoritoIds]);
     }
}