<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use App\Models\MensajeSoporte;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {

        // Total Productos
        $total_productos = Producto::count();

        // Total Ventas (pedidos entregados)
        $total_ventas = Pedido::where('estado', 'Entregado')->count();
        
        // Total Clientes (usuarios con rol usuario)
        $total_clientes = User::where('rol', 'usuario')->count();
        
        // Ventas Hoy (pedidos entregados hoy)
        $ventas_hoy = Pedido::where('estado', 'Entregado')
            ->whereDate('fecha_pedido', Carbon::today())
            ->count();

        // Productos Vendidos Hoy (con total de dinero)
        try {
            $productosVendidosHoy = DetallePedido::select(
                    'producto_id',
                    'productos.nombre as producto',
                    DB::raw('SUM(cantidad) as cantidad_vendida'),
                    DB::raw('SUM(cantidad * precio_unitario) as total_producto')
                )
                ->join('productos', 'detalles_pedido.producto_id', '=', 'productos.id')
                ->join('pedidos', 'detalles_pedido.pedido_id', '=', 'pedidos.id')
                ->whereDate('pedidos.fecha_pedido', Carbon::today())
                ->where('pedidos.estado', 'Entregado')
                ->groupBy('producto_id', 'productos.nombre')
                ->get();

            $totalGeneral = $productosVendidosHoy->sum('total_producto');
            
        } catch (Exception $e) {
            $productosVendidosHoy = collect([]);
            $totalGeneral = 0;
        }

        return view('admin.dashboard', [
            'total_productos' => $total_productos,
            'total_ventas' => $total_ventas,
            'total_clientes' => $total_clientes,
            'ventas_hoy' => $ventas_hoy,
            'productosVendidosHoy' => $productosVendidosHoy,
            'totalGeneral' => $totalGeneral,
        ]);
    }

    public function verMensajesSoporte(): View
    {
        $mensajes = MensajeSoporte::latest()->get();
        return view('admin.soporte.index', [
            'mensajes' => $mensajes
        ]);
    }
}