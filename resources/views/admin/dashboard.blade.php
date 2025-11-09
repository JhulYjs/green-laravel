@extends('layouts.admin')

@section('title', 'Dashboard Principal')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Dashboard GreenCloset</h1>
    <p class="text-gray-600 mt-2 text-sm sm:text-base">Resumen general de tu tienda ecológica</p>
</div>

<!-- Tarjetas de Métricas -->
<div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
    <!-- Total Productos -->
    <a href="{{ route('admin.productos.index') }}" class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Productos</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $total_productos }}</p>
            </div>
            <div class="bg-green-100 text-green-600 p-2 sm:p-3 rounded-lg">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
    </a>

    <!-- Total Clientes -->
    <a href="{{ route('admin.usuarios.index') }}" class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Clientes</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $total_clientes }}</p>
            </div>
            <div class="bg-blue-100 text-blue-600 p-2 sm:p-3 rounded-lg">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
            </div>
        </div>
    </a>

    <!-- Ventas Hoy -->
    <a href="{{ route('admin.pedidos.index') }}" class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Ventas Hoy</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $ventas_hoy }}</p>
            </div>
            <div class="bg-purple-100 text-purple-600 p-2 sm:p-3 rounded-lg">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
        </div>
    </a>

    <!-- Total Ventas -->
    <a href="{{ route('admin.pedidos.index') }}" class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:border-orange-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Total Ventas</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $total_ventas }}</p>
            </div>
            <div class="bg-orange-100 text-orange-600 p-2 sm:p-3 rounded-lg">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
        </div>
    </a>
</div>

<!-- Sección de Ventas del Día -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <!-- Header -->
    <div class="bg-gray-50 px-4 sm:px-6 py-4 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center">
                <div class="bg-green-100 text-green-600 p-2 sm:p-3 rounded-lg mr-3 sm:mr-4">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Productos Vendidos Hoy</h3>
                    <p class="text-gray-600 text-sm">{{ \Carbon\Carbon::now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</p>
                </div>
            </div>
            @if($productosVendidosHoy->count() > 0)
            <div class="text-center sm:text-right">
                <p class="text-gray-500 text-sm font-medium">Total Ganado</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-900">${{ number_format($totalGeneral, 2) }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Contenido -->
    <div class="p-4 sm:p-6">
        @if($productosVendidosHoy->count() > 0)
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 sm:px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Producto</th>
                            <th class="px-3 sm:px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wide">Cantidad</th>
                            <th class="px-3 sm:px-4 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wide">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($productosVendidosHoy as $producto)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-3 sm:px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-gray-100 text-gray-600 p-2 rounded-lg mr-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                        </svg>
                                    </div>
                                    <span class="text-gray-800 font-medium text-sm sm:text-base">{{ $producto->producto }}</span>
                                </div>
                            </td>
                            <td class="px-3 sm:px-4 py-3 whitespace-nowrap text-center">
                                <span class="inline-flex items-center justify-center bg-green-100 text-green-800 text-xs font-semibold px-2 sm:px-3 py-1 rounded-full">
                                    {{ $producto->cantidad_vendida }}
                                </span>
                            </td>
                            <td class="px-3 sm:px-4 py-3 whitespace-nowrap text-right">
                                <span class="text-gray-900 font-bold text-sm sm:text-base">${{ number_format($producto->total_producto, 2) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @if($productosVendidosHoy->count() > 0)
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="2" class="px-3 sm:px-4 py-3 text-right text-sm font-semibold text-gray-700">Total del Día:</td>
                            <td class="px-3 sm:px-4 py-3 text-right text-sm font-bold text-gray-900">${{ number_format($totalGeneral, 2) }}</td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        @else
            <div class="text-center py-8 sm:py-12">
                <div class="bg-gray-100 inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 rounded-full mb-4">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">No hay ventas registradas hoy</h4>
                <p class="text-gray-600 max-w-md mx-auto text-sm sm:text-base">Los productos vendidos aparecerán aquí automáticamente.</p>
            </div>
        @endif
    </div>
</div>
@endsection