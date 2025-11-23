{{-- resources/views/productos/partials/card.blade.php --}}
<div class="group bg-white rounded-2xl border border-gray-200 shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 flex flex-col overflow-hidden h-full"
     data-id="{{ $producto->id }}"
     data-nombre="{{ $producto->nombre }}"
     data-precio="{{ $producto->precio_final }}"
     data-imagen="{{ $producto->usuario_id !== null ? asset('storage/' . $producto->imagen_url) : asset($producto->imagen_url) }}"
     data-talla="{{ $producto->talla }}"
     data-estado="{{ $producto->estado }}">

    {{-- Image container --}}
    <div class="relative overflow-hidden">
        {{-- Link to product details page --}}
        <a href="{{ route('producto.show', $producto) }}">
        @php
            // Si la URL ya empieza con http (es externa) o no usa storage
            if (Str::startsWith($producto->imagen_url, 'http')) {
                $imageUrl = $producto->imagen_url;
            } else {
                // Siempre usamos storage para subidas locales
                $imageUrl = asset('storage/' . $producto->imagen_url);
            }
        @endphp
        <img src="{{ $imageUrl }}" alt="{{ $producto->nombre }}"
                 class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110">
        </a>
        
        {{-- Offer tag --}}
        @if ($producto->precio_oferta)
            <div class="absolute top-4 right-4 bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg z-10 transform hover:scale-110 transition-transform duration-300">
                🔥 OFERTA
            </div>
        @endif
        
        {{-- Favorite button --}}
        <button class="favorite-btn absolute top-4 left-4 bg-white/90 backdrop-blur-sm p-3 rounded-full text-gray-600 hover:text-red-500 transition-all duration-300 z-10 shadow-lg hover:shadow-xl transform hover:scale-110"
                data-id="{{ $producto->id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                </svg>
        </button>
    </div>

    {{-- Content container --}}
    <div class="p-5 flex flex-col flex-grow">
        {{-- Product Name --}}
        <h3 class="font-bold text-gray-800 text-lg line-clamp-2 leading-tight mb-3 min-h-[3.5rem]">{{ $producto->nombre }}</h3>
        
        {{-- Spacer --}}
        <div class="flex-grow"></div>
        
        {{-- Price section --}}
        <div class="mb-4">
            @if ($producto->precio_oferta)
                <div class="flex items-center space-x-3">
                    <span class="font-bold text-2xl text-red-600">S/{{ number_format($producto->precio_oferta, 2) }}</span>
                    <span class="text-lg text-gray-400 line-through">S/{{ number_format($producto->precio, 2) }}</span>
                </div>
            @else
                <span class="font-bold text-2xl text-emerald-600">S/{{ number_format($producto->precio, 2) }}</span>
            @endif
        </div>
        
        {{-- Size and Condition --}}
        <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center bg-gradient-to-r from-blue-50 to-cyan-50 px-3 py-1 rounded-full text-blue-700 font-semibold text-sm">
                📏 {{ $producto->talla }}
            </span>
            <span class="inline-flex items-center bg-gradient-to-r from-amber-50 to-orange-50 px-3 py-1 rounded-full text-amber-700 font-semibold text-sm">
                ⭐ {{ $producto->estado }}
            </span>
        </div>
        
        {{-- Add to Cart button --}}
        <button class="add-to-cart-btn w-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white py-3 px-6 rounded-xl font-bold text-sm hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Agregar al Carrito
        </button>
    </div>
</div>
