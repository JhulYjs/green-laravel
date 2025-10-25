{{-- resources/views/productos/partials/grid.blade.php --}}
{{-- Recibe la variable $productos --}}

{{-- El grid se define aquí directamente --}}
<div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 {{-- Ajusta las columnas según necesites --}} lg:grid-cols-3 xl:grid-cols-3 gap-6"> 

    @forelse ($productos as $producto)
        {{-- Incluye la tarjeta del producto --}}
        @include('productos.partials.card', ['producto' => $producto])
    @empty
        {{-- Mensaje si no hay productos --}}
        <div class="col-span-full text-center py-16">
            <div class="w-24 h-24 bg-brand-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <h3 class="text-xl font-semibold text-brand-700 mb-2">No se encontraron prendas</h3>
            <p class="text-brand-500 mb-6">Intenta ajustar tus filtros o términos de búsqueda</p>
            {{-- Podríamos añadir un botón JS para limpiar filtros aquí --}}
            {{-- <button onclick="document.getElementById('clear-filters-button')?.click()" class="bg-brand-500 text-white px-6 py-2 rounded-full font-semibold text-sm hover:bg-brand-600 transition-colors">Limpiar Filtros</button> --}}
        </div>
    @endforelse

</div> {{-- Cierre del div#product-grid --}}

{{-- Enlaces de Paginación (si se usa ->paginate() en el controlador) --}}
{{-- Se mostrarán debajo del grid --}}
{{-- @if (!$productos->isEmpty() && method_exists($productos, 'links'))
    <div class="mt-8">
        {{ $productos->links() }}
    </div>
@endif --}}