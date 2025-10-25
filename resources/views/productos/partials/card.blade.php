{{-- resources/views/productos/partials/card.blade.php --}}
{{-- This partial expects a $producto object --}}

<div class="group bg-white rounded-2xl border border-brand-100 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col"
     {{-- Data attributes for JavaScript (Carrito, Checkout Summary, etc.) --}}
     data-id="{{ $producto->id }}"
     data-nombre="{{ $producto->nombre }}"
     data-precio="{{ $producto->precio_final }}" {{-- Use precio_final --}}
     {{-- Ensure data-imagen also uses the correct conditional path --}}
     data-imagen="{{ $producto->usuario_id !== null ? asset('storage/' . $producto->imagen_url) : asset($producto->imagen_url) }}"
     data-talla="{{ $producto->talla }}"
     data-estado="{{ $producto->estado }}">

    {{-- Image container --}}
    <div class="relative overflow-hidden rounded-t-lg">
         {{-- Link to product details page --}}
         <a href="{{ route('producto.show', $producto) }}">
            {{-- Conditional logic to determine the correct image URL --}}
            @php
                // If usuario_id is not null, it was uploaded by admin (needs 'storage/').
                // If usuario_id is null, it's from the seeder (directly in /public).
                $imageUrl = $producto->usuario_id !== null
                    ? asset('storage/' . $producto->imagen_url)
                    : asset($producto->imagen_url);
            @endphp

            <img src="{{ $imageUrl }}" alt="{{ $producto->nombre }}"
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
        </button>
    </div>
</div>