<x-app-layout>
    <x-slot name="header">
<<<<<<< HEAD
        <h2 class="font-semibold text-xl leading-tight" style="color: #3E2723;">
=======
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
            {{ __('Detalle del Pedido') }} #{{ $pedido->id }}
        </h2>
    </x-slot>

<<<<<<< HEAD
    <div class="py-12" style="background: linear-gradient(135deg, #F5F1E6 0%, #E8DFCA 100%); min-height: 80vh;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('mis-pedidos.index') }}" class="text-sm font-semibold transition-colors duration-200 flex items-center" style="color: #E2725B;">
=======
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('mis-pedidos.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-800 flex items-center">
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Volver a Mis Pedidos
                </a>
            </div>
            
<<<<<<< HEAD
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-8">
                    <p class="text-sm font-semibold uppercase tracking-wider" style="color: #E2725B;">Detalle del Pedido</p>
                    <h1 class="text-3xl md:text-4xl font-bold font-serif mt-1" style="color: #3E2723;">Pedido #{{ $pedido->id }}</h1>
                    <p class="mt-1 text-sm" style="color: #8A9B68;">Realizado el: {{ $pedido->fecha_pedido->format('d/m/Y H:i') }}</p>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                        {{-- Columna Izquierda: Items --}}
                        <div class="md:col-span-2 space-y-4">
                            <h2 class="text-xl font-semibold mb-4" style="color: #3E2723;">Artículos del Pedido</h2>
                            @forelse ($pedido->detalles as $item)
                                <div class="bg-white rounded-xl border shadow-sm p-4 flex items-center space-x-4 transition-all duration-200 hover:shadow-md" style="border-color: #E8DFCA;">
                                    <img src="{{ asset($item->producto?->imagen_url ?? 'placeholder.jpg') }}"
                                         alt="{{ $item->producto?->nombre ?? 'Producto no disponible' }}" 
                                         class="w-16 h-20 object-cover rounded-lg border flex-shrink-0">
                                    <div class="flex-grow min-w-0">
                                        <h3 class="text-base font-semibold truncate" style="color: #3E2723;">{{ $item->producto?->nombre ?? 'Producto no disponible' }}</h3>
                                        <p class="text-sm" style="color: #8A9B68;">Precio: ${{ number_format($item->precio_unitario, 2) }}</p>
                                        <p class="text-xs" style="color: #E2725B;">Cantidad: {{ $item->cantidad }} | Talla: {{ $item->producto?->talla ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @empty
                                <p style="color: #8A9B68;">No se encontraron detalles para este pedido.</p>
=======
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
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                            @endforelse
                        </div>

                        {{-- Columna Derecha: Resumen y Dirección --}}
                        <div class="md:col-span-1 space-y-6">
<<<<<<< HEAD
                            <div class="p-6 rounded-xl border" style="background-color: #F5F1E6; border-color: #E8DFCA;">
                                <h2 class="text-xl font-semibold mb-4" style="color: #3E2723;">Resumen</h2>
=======
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <h2 class="text-xl font-semibold text-brand-700 mb-4">Resumen</h2>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                                @php
                                    // Calcular subtotal de los items (sin envío)
                                    $subtotal = $pedido->detalles->sum(function($item) {
                                        return $item->precio_unitario * $item->cantidad;
                                    });
                                    // Inferir costo de envío
                                    $costo_envio = max(0, $pedido->total - $subtotal); 
                                @endphp
<<<<<<< HEAD
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between"><span style="color: #8A9B68;">Subtotal:</span><span class="font-medium" style="color: #3E2723;">${{ number_format($subtotal, 2) }}</span></div>
                                    <div class="flex justify-between"><span style="color: #8A9B68;">Envío:</span><span class="font-medium" style="color: #3E2723;">${{ number_format($costo_envio, 2) }}</span></div>
                                    <div class="flex justify-between font-bold text-base border-t pt-3 mt-2" style="border-color: #E8DFCA; color: #3E2723;"><span>Total Pagado:</span><span style="color: #E2725B;">${{ number_format($pedido->total, 2) }}</span></div>
                                    <div class="flex justify-between items-center mt-3">
                                        <span style="color: #8A9B68;">Estado:</span>
                                        @php
                                            $estadoClase = match($pedido->estado) {
=======
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between"><span class="text-gray-600">Subtotal:</span><span class="font-medium text-brand-700">${{ number_format($subtotal, 2) }}</span></div>
                                    <div class="flex justify-between"><span class="text-gray-600">Envío:</span><span class="font-medium text-brand-700">${{ number_format($costo_envio, 2) }}</span></div>
                                    <div class="flex justify-between font-bold text-base border-t border-gray-200 pt-2 mt-2"><span class="text-brand-800">Total Pagado:</span><span class="text-brand-700">${{ number_format($pedido->total, 2) }}</span></div>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-gray-600">Estado:</span>
                                        @php
                                            $estadoClase = match($pedido->estado) { /* Misma lógica de clases que en index.blade.php */
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
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
<<<<<<< HEAD
                            <div class="p-6 rounded-xl border" style="background-color: #F5F1E6; border-color: #E8DFCA;">
                                <h2 class="text-xl font-semibold mb-4" style="color: #3E2723;">Dirección de Envío</h2>
                                <div class="text-sm space-y-1 whitespace-pre-line" style="color: #8A9B68;">
                                    {{ $pedido->direccion_envio }}
=======
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <h2 class="text-xl font-semibold text-brand-700 mb-4">Dirección de Envío</h2>
                                <div class="text-sm text-brand-600 space-y-1 whitespace-pre-line">
                                    {{ $pedido->direccion_envio }} {{-- Muestra la dirección formateada --}}
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>