<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Pedido') }} #{{ $pedido->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('mis-pedidos.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-800 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Volver a Mis Pedidos
                </a>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-sm font-semibold uppercase tracking-wider text-brand-500">Detalle del Pedido</p>
                    <h1 class="text-3xl md:text-4xl font-bold text-brand-800 font-serif mt-1">Pedido #{{ $pedido->id }}</h1>
                    <p class="text-brand-500 mt-1 text-sm">Realizado el: {{ $pedido->fecha_pedido->format('d/m/Y H:i') }}</p>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Columna Izquierda: Items --}}
                        <div class="md:col-span-2 space-y-4">
                            <h2 class="text-xl font-semibold text-brand-700 mb-4">Artículos del Pedido</h2>
                            @forelse ($pedido->detalles as $item)
                                <div class="bg-white rounded-lg border border-gray-100 shadow-sm p-4 flex items-center space-x-4">
                                    {{-- Accedemos a la relación 'producto' cargada en el controlador --}}
                                    <img src="{{ asset($item->producto?->imagen_url ?? 'placeholder.jpg') }}" {{-- Usamos optional() por si el producto fue borrado --}}
                                         alt="{{ $item->producto?->nombre ?? 'Producto no disponible' }}" 
                                         class="w-16 h-20 object-cover rounded-lg border flex-shrink-0">
                                    <div class="flex-grow min-w-0">
                                        <h3 class="text-base font-semibold text-brand-800 truncate">{{ $item->producto?->nombre ?? 'Producto no disponible' }}</h3>
                                        <p class="text-sm text-brand-600">Precio: ${{ number_format($item->precio_unitario, 2) }}</p>
                                        <p class="text-xs text-gray-500">Cantidad: {{ $item->cantidad }} | Talla: {{ $item->producto?->talla ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">No se encontraron detalles para este pedido.</p>
                            @endforelse
                        </div>

                        {{-- Columna Derecha: Resumen y Dirección --}}
                        <div class="md:col-span-1 space-y-6">
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <h2 class="text-xl font-semibold text-brand-700 mb-4">Resumen</h2>
                                @php
                                    // Calcular subtotal de los items (sin envío)
                                    $subtotal = $pedido->detalles->sum(function($item) {
                                        return $item->precio_unitario * $item->cantidad;
                                    });
                                    // Inferir costo de envío
                                    $costo_envio = max(0, $pedido->total - $subtotal); 
                                @endphp
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between"><span class="text-gray-600">Subtotal:</span><span class="font-medium text-brand-700">${{ number_format($subtotal, 2) }}</span></div>
                                    <div class="flex justify-between"><span class="text-gray-600">Envío:</span><span class="font-medium text-brand-700">${{ number_format($costo_envio, 2) }}</span></div>
                                    <div class="flex justify-between font-bold text-base border-t border-gray-200 pt-2 mt-2"><span class="text-brand-800">Total Pagado:</span><span class="text-brand-700">${{ number_format($pedido->total, 2) }}</span></div>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-gray-600">Estado:</span>
                                        @php
                                            $estadoClase = match($pedido->estado) { /* Misma lógica de clases que en index.blade.php */
                                                'Entregado' => 'bg-green-100 text-green-800',
                                                'Enviado' => 'bg-blue-100 text-blue-800',
                                                'Cancelado' => 'bg-red-100 text-red-800',
                                                'Procesando' => 'bg-yellow-100 text-yellow-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $estadoClase }}">
                                            {{ $pedido->estado }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <h2 class="text-xl font-semibold text-brand-700 mb-4">Dirección de Envío</h2>
                                <div class="text-sm text-brand-600 space-y-1 whitespace-pre-line">
                                    {{ $pedido->direccion_envio }} {{-- Muestra la dirección formateada --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>