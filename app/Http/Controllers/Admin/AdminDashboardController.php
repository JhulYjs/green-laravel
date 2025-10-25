<?php

namespace App\Http\Controllers\Admin; // Namespace correcto

use App\Http\Controllers\Controller; // Importa el Controller base
use App\Models\Pedido; // Necesitamos el modelo Pedido
use App\Models\Producto; // Necesitamos el modelo Producto
use App\Models\User; // Necesitamos el modelo User
use Illuminate\Http\Request; // Para manejar solicitudes HTTP
use App\Models\MensajeSoporte; // Modelo para los mensajes de soporte
use Illuminate\View\View; // Para type hinting

class AdminDashboardController extends Controller
{
    /**
     * Muestra la página principal del dashboard de administración.
     * Adapta la lógica de index
     * y los métodos de conteo de AdminModel
     */
    public function index(): View // Especificamos que devuelve una Vista
    {
        // Contar usuarios (excluyendo administradores)
        $total_usuarios = User::where('rol', 'usuario')->count();

        // Contar todos los productos
        $total_productos = Producto::count();

        // Calcular ventas totales (suma del 'total' de pedidos 'Entregado')
        $total_ventas = Pedido::where('estado', 'Entregado')->sum('total');

        // Pasamos los datos a la vista 'admin.dashboard' que crearemos luego
        return view('admin.dashboard', [
            'total_usuarios' => $total_usuarios,
            'total_productos' => $total_productos,
            'total_ventas' => $total_ventas,
        ]);
    }

    // --- Aquí añadiremos luego los métodos para gestionar usuarios, productos, pedidos ---
    // public function gestionarUsuarios() { ... }
    // public function gestionarProductos() { ... }
    // public function gestionarPedidos() { ... }
    // etc.
    public function verMensajesSoporte(): View // <-- NEW METHOD
    {
        // Obtenemos todos los mensajes, ordenados por más reciente
        $mensajes = MensajeSoporte::latest()->get(); // latest() ordena por created_at desc
        // Alternativa con paginación: ->paginate(20);

        // Pasamos los mensajes a la vista
        return view('admin.soporte.index', [ // Vista que crearemos
            'mensajes' => $mensajes
        ]);
    }

}