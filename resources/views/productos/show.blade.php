<x-app-layout>
<<<<<<< HEAD
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                {{ $producto->nombre }}
            </h2>
        </div>
=======
    {{-- Usamos el slot 'header' para el título, opcional --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $producto->nombre }} {{-- Accedemos a las propiedades del objeto $producto --}}
        </h2>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<<<<<<< HEAD
            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                <div class="p-8">
                    {{-- Grid Principal --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        
                        {{-- Columna de la Imagen --}}
                        <div class="relative">
                            <div class="bg-white rounded-2xl border border-gray-200 shadow-lg p-6">
=======
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Adaptación de tu producto.php --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        
                        {{-- Columna de la Imagen --}}
                        <div>
                            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
                                {{-- Dentro del div de la imagen --}}
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                                @php
                                    $imageUrl = $producto->usuario_id !== null && !str_starts_with($producto->imagen_url, 'public/')
                                        ? asset('storage/' . $producto->imagen_url)
                                        : asset($producto->imagen_url);
                                @endphp
<<<<<<< HEAD
                                <img src="{{ $imageUrl }}" alt="{{ $producto->nombre }}" 
                                     class="w-full h-96 object-cover rounded-2xl shadow-md transform hover:scale-105 transition-transform duration-500">
                                
                                {{-- Badge de Oferta --}}
                                @if ($producto->precio_oferta)
                                    <div class="absolute top-8 right-8 bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg z-10">
                                        🔥 OFERTA ESPECIAL
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Columna de Detalles --}}
                        <div class="group" 
                             data-id="{{ $producto->id }}"
                             data-nombre="{{ $producto->nombre }}"
                             data-precio="{{ $producto->precio_final }}"
=======
                                <img src="{{ $imageUrl }}" alt="{{ $producto->nombre }}" class="w-full h-auto object-cover rounded-lg">
                            </div>
                        </div>

                        {{-- Columna de Detalles y Botones --}}
                        {{-- Añadimos los data-* attributes para el JS del carrito/favoritos --}}
                        <div class="group" 
                             data-id="{{ $producto->id }}"
                             data-nombre="{{ $producto->nombre }}"
                             data-precio="{{ $producto->precio_final }}" {{-- Usamos precio_final --}}
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                             data-imagen="{{ asset($producto->imagen_url) }}"
                             data-estado="{{ $producto->estado }}"
                             data-talla="{{ $producto->talla }}">

<<<<<<< HEAD
                            <div class="bg-white rounded-2xl border border-gray-200 shadow-lg p-8">
                                {{-- Header --}}
                                <div class="mb-6">
                                    <h1 class="text-4xl md:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-emerald-700 bg-clip-text text-transparent">
                                        {{ $producto->nombre }}
                                    </h1>
                                    
                                    {{-- Precio y Estado --}}
                                    <div class="flex items-center mt-4 space-x-4">
                                        @if ($producto->precio_oferta)
                                            <span class="font-bold text-4xl text-red-600">${{ number_format($producto->precio_oferta, 2) }}</span>
                                            <span class="text-2xl text-gray-400 line-through">${{ number_format($producto->precio, 2) }}</span>
                                        @else
                                            <span class="font-bold text-4xl text-emerald-600">${{ number_format($producto->precio, 2) }}</span>
                                        @endif
                                        <span class="text-sm font-bold bg-gradient-to-r from-amber-500 to-orange-500 text-white px-4 py-2 rounded-full shadow-lg">
                                            {{ $producto->estado }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Descripción --}}
                                <div class="mb-8">
                                    <h3 class="text-lg font-bold text-gray-800 mb-3">📖 Descripción</h3>
                                    <p class="text-gray-700 text-lg leading-relaxed">{!! nl2br(e($producto->descripcion)) !!}</p>
                                </div>

                                {{-- Detalles Técnicos --}}
                                <div class="grid grid-cols-2 gap-4 mb-8">
                                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 p-4 rounded-2xl border border-emerald-200">
                                        <p class="text-sm font-bold text-emerald-700">📏 TALLA</p>
                                        <p class="text-lg font-semibold text-gray-800">{{ $producto->talla }}</p>
                                    </div>
                                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-4 rounded-2xl border border-blue-200">
                                        <p class="text-sm font-bold text-blue-700">⭐ CONDICIÓN</p>
                                        <p class="text-lg font-semibold text-gray-800">{{ $producto->estado }}</p>
                                    </div>
                                </div>

                                {{-- Botones de Acción --}}
                                <div class="space-y-4">
                                    {{-- Carrito --}}
                                    <button class="add-to-cart-btn w-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white py-4 px-6 rounded-2xl font-bold text-lg hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl">
                                        <svg class="w-6 h-6 mr-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        Agregar al Carrito
                                    </button>
                                    
                                    {{-- Favoritos --}}
                                    <button class="favorite-btn w-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 border border-gray-300 py-4 px-6 rounded-2xl font-bold text-lg hover:from-gray-200 hover:to-gray-300 transform hover:-translate-y-0.5 transition-all duration-300 shadow-md hover:shadow-lg" 
                                            data-id="{{ $producto->id }}">
                                        <svg class="w-6 h-6 mr-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                                        </svg>
                                        Añadir a Favoritos
                                    </button>
                                </div>

                                {{-- Info Adicional --}}
                                <div class="mt-8 p-4 bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl border border-amber-200">
                                    <div class="flex items-center space-x-3">
                                        <span class="text-2xl">🚚</span>
                                        <div>
                                            <p class="font-bold text-amber-800">Envío Rápido</p>
                                            <p class="text-sm text-amber-700">Recibe tu pedido en 24-48h</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
=======
                            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
                                <h1 class="text-3xl md:text-4xl font-bold text-brand-800 font-serif">{{ $producto->nombre }}</h1>
                                
                                <div class="flex items-center mt-3">
                                    {{-- Lógica de precios con Blade --}}
                                    @if ($producto->precio_oferta)
                                        <span class="font-bold text-3xl text-red-600">${{ number_format($producto->precio_oferta, 2) }}</span>
                                        <span class="text-xl text-brand-400 line-through ml-3">${{ number_format($producto->precio, 2) }}</span>
                                    @else
                                        <span class="font-bold text-3xl text-brand-700">${{ number_format($producto->precio, 2) }}</span>
                                    @endif
                                    <span class="ml-4 text-sm font-semibold bg-brand-100 text-brand-600 px-3 py-1 rounded-full">{{ $producto->estado }}</span>
                                </div>
                                
                                {{-- nl2br para saltos de línea, {!! !!} para no escapar HTML (¡cuidado!) --}}
                                <p class="mt-4 text-brand-600">{!! nl2br(e($producto->descripcion)) !!}</p> 
                                
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    {{-- Botón Add-to-cart (usará el mismo JS que ya tenemos) --}}
                                    <button class="add-to-cart-btn w-full bg-brand-500 text-white py-3 px-4 rounded-full font-semibold hover:bg-brand-600">
                                        Agregar al carrito
                                    </button>
                                    
                                    {{-- Botón Favoritos (funcionalidad pendiente) --}}
                                    <button class="favorite-btn w-full mt-3 bg-white text-brand-600 border border-brand-200 py-3 px-4 rounded-full font-semibold text-sm hover:bg-brand-50" data-id="{{ $producto->id }}">
                                        {{-- El icono se añadirá con JS --}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                </div>
            </div>
        </div>
    </div>
</x-app-layout>