@extends('layouts.admin')

@section('title', 'Dashboard Principal')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-green-900">Dashboard GreenCloset</h1>
    <p class="text-green-700 mt-2">Resumen general de tu tienda ecológica</p>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">

    <!-- Total Productos -->
    <a href="{{ route('admin.productos.index') }}" style="background: linear-gradient(135deg, #1b5e20, #2e7d32);" class="border border-green-900 rounded-xl p-5 shadow-lg hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-green-100 uppercase tracking-wide mb-1">Productos</p>
                <p class="text-2xl font-bold text-white">{{ $total_productos }}</p>
            </div>
            <div style="background-color:#145a32;" class="text-white p-3 rounded-lg shadow-md">
                <i class="fas fa-box text-lg"></i>
            </div>
        </div>
    </a>

    <!-- Total Clientes -->
    <a href="{{ route('admin.usuarios.index') }}" style="background: linear-gradient(135deg, #1b5e20, #2e7d32);" class="border border-green-900 rounded-xl p-5 shadow-lg hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-green-100 uppercase tracking-wide mb-1">Clientes</p>
                <p class="text-2xl font-bold text-white">{{ $total_clientes }}</p>
            </div>
            <div style="background-color:#145a32;" class="text-white p-3 rounded-lg shadow-md">
                <i class="fas fa-users text-lg"></i>
            </div>
        </div>
    </a>

    <!-- Ventas Hoy -->
    <a href="{{ route('admin.pedidos.index') }}" style="background: linear-gradient(135deg, #1b5e20, #2e7d32);" class="border border-green-900 rounded-xl p-5 shadow-lg hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-green-100 uppercase tracking-wide mb-1">Ventas Hoy</p>
                <p class="text-2xl font-bold text-white">{{ $ventas_hoy }}</p>
            </div>
            <div style="background-color:#145a32;" class="text-white p-3 rounded-lg shadow-md">
                <i class="fas fa-shopping-bag text-lg"></i>
            </div>
        </div>
    </a>

    <!-- Total Ventas -->
    <a href="{{ route('admin.pedidos.index') }}" style="background: linear-gradient(135deg, #1b5e20, #2e7d32);" class="border border-green-900 rounded-xl p-5 shadow-lg hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-green-100 uppercase tracking-wide mb-1">Total Ventas</p>
                <p class="text-2xl font-bold text-white">{{ $total_ventas }}</p>
            </div>
            <div style="background-color:#145a32;" class="text-white p-3 rounded-lg shadow-md">
                <i class="fas fa-chart-bar text-lg"></i>
            </div>
        </div>
    </a>

</div>

<!-- Sección de Ventas del Día -->
<div class="rounded-xl shadow-lg border border-green-900 overflow-hidden">
    <div style="background: linear-gradient(135deg, #1b5e20, #2e7d32);" class="px-6 py-4 flex items-center justify-between">
        <div class="flex items-center">
            <div style="background-color:#145a32;" class="text-white p-3 rounded-lg mr-4 shadow-md">
                <i class="fas fa-chart-line text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white">Productos Vendidos Hoy</h3>
                <p class="text-green-200 text-sm">{{ \Carbon\Carbon::now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</p>
            </div>
        </div>
        @if($productosVendidosHoy->count() > 0)
        <div class="text-right">
            <p class="text-green-200 text-sm font-medium">Total Ganado</p>
            <p class="text-2xl font-bold text-white">${{ number_format($totalGeneral, 2) }}</p>
        </div>
        @endif
    </div>

    <div class="p-6 bg-gray-50 rounded-b-xl">
        @if($productosVendidosHoy->count() > 0)
            <div class="overflow-x-auto rounded-lg border border-gray-300">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-green-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-green-900 uppercase tracking-wide">Producto</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-green-900 uppercase tracking-wide">Cantidad Vendida</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-green-900 uppercase tracking-wide">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($productosVendidosHoy as $producto)
                        <tr class="hover:bg-green-50 transition-colors">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div style="background-color:#145a32;" class="text-white p-2 rounded-lg mr-3 shadow-sm">
                                        <i class="fas fa-leaf text-sm"></i>
                                    </div>
                                    <span class="text-gray-800 font-medium">{{ $producto->producto }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">
                                <span style="background-color:#e6f4ea;" class="inline-flex items-center justify-center text-green-900 text-sm font-semibold px-3 py-1 rounded-full shadow-sm">
                                    {{ $producto->cantidad_vendida }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right">
                                <span class="text-gray-900 font-bold text-sm">${{ number_format($producto->total_producto, 2) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @if($productosVendidosHoy->count() > 0)
                    <tfoot class="bg-green-100">
                        <tr>
                            <td colspan="2" class="px-4 py-3 text-right text-sm font-semibold text-green-900">Total del Día:</td>
                            <td class="px-4 py-3 text-right text-sm font-bold text-green-900">${{ number_format($totalGeneral, 2) }}</td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <div style="background-color:#145a32;" class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4 shadow-md">
                    <i class="fas fa-shopping-cart text-white text-2xl"></i>
                </div>
                <h4 class="text-lg font-bold text-green-900 mb-2">No hay ventas registradas hoy</h4>
                <p class="text-green-700 max-w-md mx-auto">Los productos vendidos aparecerán aquí automáticamente.</p>
            </div>
        @endif
    </div>
</div>
@endsection
