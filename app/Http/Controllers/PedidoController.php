<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PedidoController extends Controller
{
    /**
     * Almacena un nuevo pedido en la base de datos.
     * Reemplaza la lógica de 'procesar'
     * y 'crearPedido'
     */
    public function store(Request $request) // Laravel inyecta el objeto Request
    {
        // 1. Validar los datos de entrada (dirección, etc.)
        //    Usamos las reglas de validación de Laravel.
        try {
            $validatedData = $request->validate([
                'direccion' => ['required', 'string', 'max:255'],
                'ciudad'    => ['required', 'string', 'max:100'],
                'cp'        => ['required', 'string', 'max:10'],
                'telefono'  => ['required', 'string', 'max:20'],
            ]);
        } catch (ValidationException $e) {
            // Si la validación falla, devuelve un error JSON
            return response()->json([
                'status' => 'error',
                'message' => 'Faltan datos de envío o son inválidos.',
                'errors' => $e->errors(), // Opcional: devuelve los errores específicos
            ], 422); // 422 Unprocessable Entity
        }


        $user = Auth::user(); // Obtener usuario autenticado

        // Formatear la dirección como en tu proyecto original
        $direccion_completa = "Dirección: {$validatedData['direccion']}\nCiudad: {$validatedData['ciudad']}\nCódigo Postal: {$validatedData['cp']}\nTeléfono: {$validatedData['telefono']}";

        // Usar una transacción para asegurar que todo se guarde o nada
        try {
            DB::beginTransaction();

            // 2. Obtener los items del carrito usando la relación Eloquent
            $carritoItems = $user->carrito()->withPivot('cantidad')->get();

            if ($carritoItems->isEmpty()) {
                throw new \Exception("El carrito está vacío.");
            }

            // 3. Calcular el total (items + envío)
            $subtotal = 0;
            foreach ($carritoItems as $item) {
                // Usamos el precio final (oferta o normal) del modelo Producto
                // Asumiendo que 'precio_final' está disponible como atributo
                 $subtotal += $item->precio_final * ($item->pivot->cantidad ?? 1);
            }
            $costo_envio = 10.00; // Podría venir de config('app.costo_envio')
            $total_pedido = $subtotal + $costo_envio;

            // 4. Crear el registro principal del Pedido
            $pedido = Pedido::create([
                'usuario_id' => $user->id,
                'total' => $total_pedido,
                'direccion_envio' => $direccion_completa,
                'estado' => 'Procesando', // Estado inicial por defecto
            ]);

            // 5. Crear los detalles del pedido (tabla detalles_pedido)
            $detallesParaGuardar = [];
            foreach ($carritoItems as $item) {
                $detallesParaGuardar[] = [
                    'producto_id' => $item->id,
                    'cantidad' => $item->pivot->cantidad ?? 1,
                    'precio_unitario' => $item->precio_final, // Guardamos el precio al momento de la compra
                ];
            }
            // Creamos todos los detalles asociados al pedido de una vez
            $pedido->detalles()->createMany($detallesParaGuardar);

            // 6. Vaciar el carrito del usuario
            $user->carrito()->detach(); // Elimina todas las entradas de la tabla pivote

            // 7. Confirmar la transacción
            DB::commit();

            // 8. Devolver respuesta JSON de éxito con el ID del pedido
            return response()->json([
                'status' => 'success',
                'message' => '¡Pedido realizado con éxito!',
                'pedido_id' => $pedido->id
            ]);

        } catch (\Exception $e) {
            // 9. Si algo falla, revertir la transacción
            DB::rollBack();
            report($e); // Reporta el error a los logs de Laravel

            // 10. Devolver respuesta JSON de error
            return response()->json([
                'status' => 'error',
                'message' => 'Error al procesar el pedido: ' . $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Muestra el historial de pedidos del usuario autenticado.
     * Reemplaza mostrarMisPedidos
     */
    public function index() // NUEVO MÉTODO
    {
        $user = Auth::user();
        
        // Obtenemos los pedidos del usuario, ordenados por fecha descendente
        // Cargamos la relación 'detalles' para saber cuántos items tiene cada pedido (opcional)
        $pedidos = Pedido::where('usuario_id', $user->id)
                         ->withCount('detalles') // Cuenta cuántos registros hay en la relación 'detalles'
                         ->latest('fecha_pedido') // Ordena por fecha_pedido DESC
                         ->get();

        return view('pedidos.index', ['pedidos' => $pedidos]); // Nueva vista
    }

    /**
     * Muestra el detalle de un pedido específico del usuario.
     * Reemplaza mostrarDetallePedido
     */
    public function show(Pedido $pedido) // NUEVO MÉTODO (Usa Route Model Binding)
    {
        // Verificar que el pedido pertenece al usuario actual
        if ($pedido->usuario_id !== Auth::id()) {
            abort(403, 'No autorizado para ver este pedido.');
        }

        // Cargar las relaciones necesarias para mostrar los detalles:
        // - 'detalles': para la lista de items
        // - 'detalles.producto': para obtener nombre, imagen, etc. de cada item
        $pedido->load(['detalles', 'detalles.producto']);

        return view('pedidos.show', ['pedido' => $pedido]); // Nueva vista
    }

    // ... (método exito existente) ...
     public function exito(Pedido $pedido) // Laravel inyecta el Pedido gracias al Route Model Binding
     {
        // Verifica si el pedido pertenece al usuario actual (seguridad extra)
        if ($pedido->usuario_id !== Auth::id()) {
            abort(403, 'No autorizado para ver este pedido.'); // Muestra error 403 si no es suyo
        }

        // Devuelve la nueva vista Blade, pasando el objeto $pedido
         return view('pedidos.exito', [ // Asegúrate que esta vista exista en resources/views/pedidos/exito.blade.php
             'pedido' => $pedido
         ]);
     }    
}
