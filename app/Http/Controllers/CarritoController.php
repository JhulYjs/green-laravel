<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Agrega un producto al carrito del usuario.
     */
    public function add(Request $request, Producto $producto)
    {
        // ... (código existente) ...
        $user = Auth::user(); 
        $user->carrito()->syncWithoutDetaching([$producto->id]);
        return response()->json(['status' => 'success', 'message' => 'Producto agregado al carrito']);
    }

    /**
     * Obtiene los productos del carrito del usuario.
     * Reemplaza lógica de getCarrito
     */
    public function get() // NUEVO MÉTODO
    {
        $user = Auth::user();
        // Cargamos la relación 'carrito' que definimos en el Modelo User
        // Incluimos los detalles del pivote ('cantidad' y 'fecha_agregado')
        $carritoItems = $user->carrito()->withPivot('cantidad', 'fecha_agregado')->get(); 
        
        return response()->json(['status' => 'success', 'carrito' => $carritoItems]);
    }

    /**
     * Elimina un producto del carrito del usuario.
     * Reemplaza lógica de quitarDelCarrito
     */
    public function remove(Request $request, Producto $producto) // NUEVO MÉTODO
    {
        $user = Auth::user();
        // 'detach' elimina la relación entre el usuario y este producto en la tabla pivote
        $user->carrito()->detach($producto->id);

        return response()->json(['status' => 'success', 'message' => 'Producto eliminado del carrito']);
    }
}