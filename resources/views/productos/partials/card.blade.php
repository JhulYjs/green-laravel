{{-- resources/views/productos/partials/card.blade.php --}}
<<<<<<< HEAD
<div class="group bg-white rounded-2xl border border-gray-200 shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 flex flex-col overflow-hidden"
     data-id="{{ $producto->id }}"
     data-nombre="{{ $producto->nombre }}"
     data-precio="{{ $producto->precio_final }}"
=======
{{-- This partial expects a $producto object --}}

<div class="group bg-white rounded-2xl border border-brand-100 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col"
     {{-- Data attributes for JavaScript (Carrito, Checkout Summary, etc.) --}}
     data-id="{{ $producto->id }}"
     data-nombre="{{ $producto->nombre }}"
     data-precio="{{ $producto->precio_final }}" {{-- Use precio_final --}}
     {{-- Ensure data-imagen also uses the correct conditional path --}}
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
     data-imagen="{{ $producto->usuario_id !== null ? asset('storage/' . $producto->imagen_url) : asset($producto->imagen_url) }}"
     data-talla="{{ $producto->talla }}"
     data-estado="{{ $producto->estado }}">

    {{-- Image container --}}
<<<<<<< HEAD
    <div class="relative overflow-hidden">
        {{-- Link to product details page --}}
        <a href="{{ route('producto.show', $producto) }}">
            @php
=======
    <div class="relative overflow-hidden rounded-t-lg">
         {{-- Link to product details page --}}
         <a href="{{ route('producto.show', $producto) }}">
            {{-- Conditional logic to determine the correct image URL --}}
            @php
                // If usuario_id is not null, it was uploaded by admin (needs 'storage/').
                // If usuario_id is null, it's from the seeder (directly in /public).
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                $imageUrl = $producto->usuario_id !== null
                    ? asset('storage/' . $producto->imagen_url)
                    : asset($producto->imagen_url);
            @endphp

            <img src="{{ $imageUrl }}" alt="{{ $producto->nombre }}"
<<<<<<< HEAD
                 class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-110">
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
    <div class="p-6 flex flex-col flex-grow">
        {{-- Product Name --}}
        <h3 class="font-bold text-gray-800 text-lg h-14 line-clamp-2 leading-tight mb-3">{{ $producto->nombre }}</h3>
        
        {{-- Spacer --}}
        <div class="flex-grow"></div>
        
        {{-- Price section --}}
        <div class="mb-4">
            @if ($producto->precio_oferta)
                <div class="flex items-center space-x-3">
                    <span class="font-bold text-2xl text-red-600">${{ number_format($producto->precio_oferta, 2) }}</span>
                    <span class="text-lg text-gray-400 line-through">${{ number_format($producto->precio, 2) }}</span>
                </div>
            @else
                <span class="font-bold text-2xl text-emerald-600">${{ number_format($producto->precio, 2) }}</span>
            @endif
        </div>
        
        {{-- Size and Condition --}}
        <div class="flex items-center justify-between mb-6">
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
=======
                 class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-105">
        </a>
         {{-- Offer tag --}}
         @if ($producto->precio_oferta)
            <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full z-10 shadow-lg">Oferta</div>
         @endif
         {{-- Favorite button (icon added by favoritos.js) --}}
         <button class="favorite-btn absolute top-3 left-3 bg-white/80 backdrop-blur-sm p-2 rounded-full text-brand-500 hover:text-red-500 transition-colors z-10 shadow-lg"
                data-id="{{ $producto->id }}">
                {{-- SVG icon will be inserted here by favoritos.js --}}
        </button>
    </div>

    {{-- Text content and buttons container --}}
    <div class="p-4 flex flex-col flex-grow">
        {{-- Product Name --}}
        <h3 class="font-semibold text-brand-800 h-12 line-clamp-2 leading-tight">{{ $producto->nombre }}</h3>
        {{-- Spacer to push content down --}}
        <div class="flex-grow"></div>
        {{-- Price section --}}
        <div class="mt-3">
            @if ($producto->precio_oferta)
                <span class="font-bold text-red-600 text-lg">${{ number_format($producto->precio_oferta, 2) }}</span>
                <span class="text-sm text-brand-400 line-through ml-2">${{ number_format($producto->precio, 2) }}</span>
            @else
                <span class="font-bold text-brand-700 text-lg">${{ number_format($producto->precio, 2) }}</span>
            @endif
        </div>
        {{-- Size and Condition --}}
        <div class="flex items-center justify-between mt-2 text-xs text-brand-500">
            <span>Talla: {{ $producto->talla }}</span>
            <span class="bg-brand-100 px-2 py-1 rounded-full">{{ $producto->estado }}</span>
        </div>
        {{-- Add to Cart button --}}
        <button class="add-to-cart-btn w-full mt-4 bg-brand-500 text-white py-2.5 px-4 rounded-full font-semibold text-sm hover:bg-brand-600 transition-colors duration-200 shadow-md hover:shadow-lg">
            Agregar al carrito
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
        </button>
    </div>
</div>