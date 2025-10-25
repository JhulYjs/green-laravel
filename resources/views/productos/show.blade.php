<x-app-layout>
    {{-- Usamos el slot 'header' para el título, opcional --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $producto->nombre }} {{-- Accedemos a las propiedades del objeto $producto --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Adaptación de tu producto.php --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        
                        {{-- Columna de la Imagen --}}
                        <div>
                            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
                                {{-- Dentro del div de la imagen --}}
                                @php
                                    $imageUrl = $producto->usuario_id !== null && !str_starts_with($producto->imagen_url, 'public/')
                                        ? asset('storage/' . $producto->imagen_url)
                                        : asset($producto->imagen_url);
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $producto->nombre }}" class="w-full h-auto object-cover rounded-lg">
                            </div>
                        </div>

                        {{-- Columna de Detalles y Botones --}}
                        {{-- Añadimos los data-* attributes para el JS del carrito/favoritos --}}
                        <div class="group" 
                             data-id="{{ $producto->id }}"
                             data-nombre="{{ $producto->nombre }}"
                             data-precio="{{ $producto->precio_final }}" {{-- Usamos precio_final --}}
                             data-imagen="{{ asset($producto->imagen_url) }}"
                             data-estado="{{ $producto->estado }}"
                             data-talla="{{ $producto->talla }}">

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
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>