<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido; // Importar modelo Pedido
use Illuminate\Http\Request;
use Illuminate\View\View; // Para type hinting
use Illuminate\Http\RedirectResponse; // Para type hinting
use Illuminate\Validation\Rule; // Para validación de estado
use Illuminate\Support\Facades\Auth; // Necesario para Auth::id() si añadieras verificaciones extras

class AdminPedidoController extends Controller
{
    /**
     * Muestra la lista de todos los pedidos en el panel de administración.
     * Adapta getTodosLosPedidos
     */
    public function index(): View
    {
        // Obtenemos todos los pedidos, cargando la relación 'usuario' (comprador)
        // Ordenamos por fecha descendente
        $pedidos = Pedido::with('usuario') // Carga la info del comprador
                         ->latest('fecha_pedido') // Ordena por fecha_pedido DESC
                         ->get();
                         // ->paginate(15); // Alternativa con paginación

        return view('admin.pedidos.index', [ // Vista que crearemos luego
            'pedidos' => $pedidos
        ]);
    }

    /**
     * Muestra los detalles completos de un pedido específico.
     * Adapta getPedidoConDetallesAdmin
     */
    public function show(Pedido $pedido): View // Usa Route Model Binding
    {
        // Laravel ya busca el pedido. Si no existe, da 404.
        // Cargamos las relaciones necesarias:
        // - 'usuario': Para mostrar los datos del comprador
        // - 'detalles': Para la lista de items
        // - 'detalles.producto': Para obtener nombre, imagen, talla de cada item
        $pedido->load(['usuario', 'detalles', 'detalles.producto']);

        return view('admin.pedidos.show', [ // Vista que crearemos luego
            'pedido' => $pedido
        ]);
    }

    /**
     * Actualiza el estado de un pedido específico.
     * Adapta procesarActualizarEstadoPedido
     * y actualizarEstadoPedidoAdmin
     */
    public function updateEstado(Request $request, Pedido $pedido): RedirectResponse // Usa Route Model Binding
    {
        // Validar que el nuevo estado sea uno de los permitidos
        $validated = $request->validate([
            'nuevo_estado' => ['required', Rule::in(['Procesando', 'Enviado', 'Entregado', 'Cancelado'])],
        ]);

        // Actualizar el estado del pedido
        $pedido->estado = $validated['nuevo_estado'];
        $pedido->save(); // Guarda el cambio en la base de datos

        // Redirigir de vuelta a la vista de detalles del pedido con un mensaje de éxito
        return redirect()->route('admin.pedidos.show', $pedido)
                         ->with('status_success', 'Estado del pedido actualizado correctamente.');
    }
}