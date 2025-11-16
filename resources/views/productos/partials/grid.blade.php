{{-- resources/views/productos/partials/grid.blade.php --}}
{{-- Grid RESPONSIVE --}}
<div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5 lg:gap-6">

    @forelse ($productos as $producto)
        @include('productos.partials.card', ['producto' => $producto])
    @empty
        {{-- Estado Vacío RESPONSIVE --}}
        <div class="col-span-full text-center py-12 sm:py-20 px-4">
            <div class="w-20 h-20 sm:w-32 sm:h-32 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                <svg class="w-10 h-10 sm:w-16 sm:h-16 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-gray-700 mb-3">No se encontraron prendas</h3>
            <p class="text-gray-500 text-base sm:text-lg mb-6 sm:mb-8 max-w-md mx-auto leading-relaxed">
                Intenta ajustar tus filtros o términos de búsqueda.
            </p>
            <button onclick="document.getElementById('clear-filters-button')?.click()" 
                    class="inline-flex items-center px-6 py-3 sm:px-8 sm:py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-xl sm:rounded-2xl shadow-lg hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-0.5 sm:hover:-translate-y-1 transition-all duration-300 text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

