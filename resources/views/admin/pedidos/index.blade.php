@extends('layouts.admin')

@section('title', 'Gestión de Pedidos')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Listado de Pedidos</h2>
            <p class="text-gray-600 text-sm mt-1">Gestiona todos los pedidos de tu tienda</p>
        </div>

        {{-- Mensajes Flash --}}
        @if (session('status_success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg text-sm flex items-center" role="alert">
                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('status_success') }}
            </div>
        @elseif (session('status_error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg text-sm flex items-center" role="alert">
                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                {{ session('status_error') }}
            </div>
        @endif

        <!-- Tabla de Pedidos -->
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">ID Pedido</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Fecha</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Comprador</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Total</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Estado</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pedidos as $pedido)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm text-gray-900 font-medium">#{{ $pedido->id }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                <div class="flex flex-col">
                                    <span>{{ $pedido->fecha_pedido->format('d/m/Y') }}</span>
                                    <span class="text-xs text-gray-500">{{ $pedido->fecha_pedido->format('H:i') }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ optional($pedido->usuario)->nombre_completo ?? 'Usuario eliminado' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900 font-semibold">${{ number_format($pedido->total, 2) }}</td>
                            <td class="px-4 py-3 text-sm">
                                @php
                                    $estadoConfig = match($pedido->estado) {
                                        'Entregado' => ['class' => 'bg-green-100 text-green-800', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'Enviado' => ['class' => 'bg-blue-100 text-blue-800', 'icon' => 'M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z'],
                                        'Cancelado' => ['class' => 'bg-red-100 text-red-800', 'icon' => 'M6 18L18 6M6 6l12 12'],
                                        'Procesando' => ['class' => 'bg-yellow-100 text-yellow-800', 'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'],
                                        default => ['class' => 'bg-gray-100 text-gray-800', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z']
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $estadoConfig['class'] }}">
                                    <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $estadoConfig['icon'] }}"/>
                                    </svg>
                                    {{ $pedido->estado }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm font-medium">
                                <a href="{{ route('admin.pedidos.show', $pedido) }}" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-900 transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Ver Detalles
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    <p class="text-gray-600 font-medium">No se encontraron pedidos</p>
                                    <p class="text-gray-500 text-sm mt-1">No hay pedidos registrados en el sistema</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación (si existe) -->
        @if(method_exists($pedidos, 'links') && $pedidos->hasPages())
            <div class="mt-6">
                {{ $pedidos->links() }}
            </div>
        @endif
    </div>
@endsection