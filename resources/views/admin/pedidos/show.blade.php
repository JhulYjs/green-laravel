@extends('layouts.admin')

@section('title', 'Detalle Pedido #' . $pedido->id)

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Botón Volver -->
        <div class="mb-6">
            <a href="{{ route('admin.pedidos.index') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a Pedidos
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <!-- Cabecera con Estado -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6 pb-6 border-b border-gray-200">
                <div class="mb-4 lg:mb-0">
                    <h1 class="text-2xl font-semibold text-gray-900">Detalle Pedido #{{ $pedido->id }}</h1>
                    <p class="text-gray-600 mt-1 text-sm">Realizado el: {{ $pedido->fecha_pedido->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    @php
                        $estadoConfig = match($pedido->estado) {
                            'Entregado' => ['class' => 'bg-green-100 text-green-800', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            'Enviado' => ['class' => 'bg-blue-100 text-blue-800', 'icon' => 'M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z'],
                            'Cancelado' => ['class' => 'bg-red-100 text-red-800', 'icon' => 'M6 18L18 6M6 6l12 12'],
                            'Procesando' => ['class' => 'bg-yellow-100 text-yellow-800', 'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'],
                            default => ['class' => 'bg-gray-100 text-gray-800', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z']
                        };
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $estadoConfig['class'] }}">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $estadoConfig['icon'] }}"/>
                        </svg>
                        {{ $pedido->estado }}
                    </span>
                </div>
            </div>

            <!-- Mensajes Flash -->
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

            <!-- Errores de Validación -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg text-sm" role="alert">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <span class="font-medium">Error de validación</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                <!-- Columna Izquierda: Items -->
                <div class="xl:col-span-2 space-y-4">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Artículos del Pedido
                    </h2>
                    
                    @forelse ($pedido->detalles as $item)
                        <div class="bg-gray-50 rounded-lg p-4 flex items-start space-x-4 border border-gray-200">
                            <img src="{{ asset(optional($item->producto)->imagen_url ?? 'placeholder.jpg') }}" 
                                 alt="{{ optional($item->producto)->nombre ?? 'Producto no disponible' }}" 
                                 class="w-16 h-20 object-cover rounded-lg border border-gray-300 flex-shrink-0">
                            <div class="flex-grow min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">
                                    @if($item->producto)
                                        <a href="{{ route('producto.show', $item->producto) }}" target="_blank" class="hover:text-blue-600 transition-colors">
                                            {{ $item->producto->nombre }}
                                        </a>
                                    @else
                                        Producto no disponible
                                    @endif
                                </p>
                                <div class="flex flex-wrap gap-4 mt-2 text-xs text-gray-600">
                                    <span>Precio: ${{ number_format($item->precio_unitario, 2) }}</span>
                                    <span>Cantidad: {{ $item->cantidad }}</span>
                                    <span>Talla: {{ optional($item->producto)->talla ?? 'N/A' }}</span>
                                </div>
                                <p class="text-sm font-medium text-gray-900 mt-2">
                                    Subtotal: ${{ number_format($item->precio_unitario * $item->cantidad, 2) }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <p>No se encontraron artículos para este pedido.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Columna Derecha: Información Adicional -->
                <div class="xl:col-span-1 space-y-6">
                    <!-- Resumen Financiero -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            Resumen Financiero
                        </h2>
                        <div class="space-y-2 text-sm">
                            @php
                                $subtotal = $pedido->detalles->sum(fn($item) => $item->precio_unitario * $item->cantidad);
                                $costo_envio = max(0, $pedido->total - $subtotal);
                            @endphp
                            <div class="flex justify-between"><span class="text-gray-600">Subtotal:</span><span class="font-medium text-gray-900">${{ number_format($subtotal, 2) }}</span></div>
                            <div class="flex justify-between"><span class="text-gray-600">Envío:</span><span class="font-medium text-gray-900">${{ number_format($costo_envio, 2) }}</span></div>
                            <div class="flex justify-between font-bold border-t border-gray-300 pt-2 mt-2">
                                <span class="text-gray-900">Total:</span>
                                <span class="text-gray-900">${{ number_format($pedido->total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Datos del Comprador -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Datos del Comprador
                        </h2>
                        <div class="space-y-1 text-sm">
                            <p class="font-medium text-gray-900">{{ optional($pedido->usuario)->nombre_completo ?? 'Usuario eliminado' }}</p>
                            <p class="text-gray-600">{{ optional($pedido->usuario)->email ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Dirección de Envío -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Dirección de Envío
                        </h2>
                        <div class="text-sm text-gray-600 whitespace-pre-line leading-relaxed">
                            {{ $pedido->direccion_envio }}
                        </div>
                    </div>

                    <!-- Actualizar Estado -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Actualizar Estado
                        </h2>
                        <form action="{{ route('admin.pedidos.updateEstado', $pedido) }}" method="POST" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            @csrf
                            @method('PUT')
                            <select name="nuevo_estado" class="flex-grow bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                                @foreach (['Procesando', 'Enviado', 'Entregado', 'Cancelado'] as $estado_opt)
                                    <option value="{{ $estado_opt }}" @selected($pedido->estado == $estado_opt)>
                                        {{ $estado_opt }}
                                    </option>
                                @endforeach
                            </select>
                            <x-primary-button type="submit" class="w-full sm:w-auto justify-center px-4 py-2 text-sm font-medium bg-blue-600 hover:bg-blue-700 transition-colors">
                                Actualizar
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection