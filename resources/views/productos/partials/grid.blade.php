{{-- resources/views/productos/partials/grid.blade.php --}}
<<<<<<< HEAD
<div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

    @forelse ($productos as $producto)
        @include('productos.partials.card', ['producto' => $producto])
    @empty
        {{-- Estado Vacío --}}
        <div class="col-span-full text-center py-20">
            <div class="w-32 h-32 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                <svg class="w-16 h-16 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 mb-3">No se encontraron prendas</h3>
            <p class="text-gray-500 text-lg mb-8 max-w-md mx-auto leading-relaxed">
                Intenta ajustar tus filtros o términos de búsqueda para encontrar lo que buscas.
            </p>
            <button onclick="document.getElementById('clear-filters-button')?.click()" 
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-2xl shadow-lg hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-1 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Limpiar Filtros
            </button>
        </div>
    @endforelse

</div>

{{-- Paginación --}}
@if (!$productos->isEmpty() && method_exists($productos, 'links'))
    <div class="mt-12 flex justify-center">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 px-6 py-4">
            {{ $productos->links() }}
        </div>
    </div>
@endif
=======
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
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
