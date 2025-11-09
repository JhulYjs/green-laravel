<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3 sm:space-x-4">
            <div class="p-3 sm:p-4 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl sm:rounded-2xl shadow-lg relative overflow-hidden group">
                {{-- Imagen de fondo --}}
                <div class="absolute inset-0 bg-cover bg-center opacity-20 transition-transform duration-500 group-hover:scale-110" 
                     style="background-image: url('https://images.unsplash.com/photo-1607082350899-7e105aa886ae?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80')">
                </div>
                {{-- Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-r from-red-500 to-pink-500 opacity-90 group-hover:opacity-80 transition-opacity duration-300"></div>
                {{-- Icono moderno --}}
                <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white relative z-10 transform group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M11 8.75V3.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v3.75h1.75c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5H14v3.75c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5V11.75H9.75c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5H11z"/>
                </svg>
            </div>
            <h2 class="font-bold text-xl sm:text-2xl text-gray-800 leading-tight bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">
                {{ __('Ofertas Especiales') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Cabecera de Ofertas RESPONSIVE --}}
            <div class="bg-gradient-to-r from-red-50 via-pink-50 to-orange-50 rounded-xl sm:rounded-2xl p-6 sm:p-8 lg:p-10 mb-8 sm:mb-12 border border-red-200 shadow-lg">
                <div class="flex flex-col sm:flex-row items-start sm:items-center mb-4 sm:mb-6">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl sm:rounded-2xl flex items-center justify-center mr-0 sm:mr-6 mb-4 sm:mb-0 shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11 8.75V3.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v3.75h1.75c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5H14v3.75c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5V11.75H9.75c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5H11z"/>
                        </svg>
                    </div>
                    <div class="text-center sm:text-left">
                        <div class="inline-flex items-center space-x-2 bg-red-100 px-3 py-1 sm:px-4 sm:py-2 rounded-full mb-2">
                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13 2.05v3.03c3.39.49 6 3.39 6 6.92 0 .9-.18 1.75-.5 2.54l2.62 1.53c.56-1.24.88-2.62.88-4.07 0-5.18-3.95-9.45-9-9.95zM12 19c-3.87 0-7-3.13-7-7 0-3.53 2.61-6.43 6-6.92V2.05c-5.06.5-9 4.76-9 9.95 0 5.52 4.47 10 9.99 10 3.31 0 6.24-1.61 8.06-4.09l-2.6-1.53C16.17 17.98 14.21 19 12 19z"/>
                            </svg>
                            <span class="text-xs sm:text-sm font-bold text-red-700 uppercase tracking-wide">Ofertas Especiales</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-red-600 bg-clip-text text-transparent leading-tight">
                            Últimas<br class="sm:hidden"> Oportunidades
                        </h1>
                    </div>
                </div>
                <p class="text-gray-600 text-base sm:text-lg max-w-2xl leading-relaxed text-center sm:text-left">
                    Aprovecha nuestros precios especiales en prendas seleccionadas. Descuentos exclusivos por tiempo limitado.
                </p>
            </div>

            {{-- Layout FLEX con Sidebar y Grid RESPONSIVE --}}
            <div class="flex flex-col lg:flex-row gap-4 sm:gap-6 lg:gap-8 mt-6 sm:mt-8">
                {{-- Sidebar de Filtros RESPONSIVE --}}
                <aside class="w-full lg:w-80 flex-shrink-0">
                    {{-- Botón para mostrar/ocultar filtros en móviles --}}
                    <div class="lg:hidden mb-4">
                        <button id="filters-toggle" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 font-semibold text-gray-700 flex items-center justify-center shadow-sm hover:shadow-md transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                            </svg>
                            Mostrar Filtros
                        </button>
                    </div>

                    <div id="filters-container" class="bg-gradient-to-br from-white to-gray-50 p-4 sm:p-6 rounded-xl sm:rounded-2xl border border-gray-200 shadow-lg sticky top-24 hidden lg:block">
                        <h3 class="font-bold text-red-600 text-base sm:text-lg mb-4 sm:mb-6 flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z"/>
                            </svg>
                            FILTRAR OFERTAS
                        </h3>
                        <div class="space-y-4 sm:space-y-6">
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Buscar ofertas</label>
                                <div class="relative">
                                    <input type="text" id="search-input" name="busqueda" placeholder="Buscar..."
                                           class="filter-input w-full bg-gray-50 border border-gray-300 rounded-lg sm:rounded-xl px-3 py-2 sm:px-4 sm:py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 pl-10">
                                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Categoría</label>
                                <select name="categoria" class="filter-input w-full bg-gray-50 border border-gray-300 rounded-lg sm:rounded-xl px-3 py-2 sm:px-4 sm:py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Todas las categorías</option>
                                    @foreach ($categorias ?? [] as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Rango de Precio</label>
                                <div class="grid grid-cols-2 gap-2 sm:gap-3">
                                    <div class="relative">
                                        <span class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500 text-xs">$</span>
                                        <input type="number" name="precio_min" placeholder="Mín" 
                                               class="filter-input w-full bg-gray-50 border border-gray-300 rounded-lg sm:rounded-xl px-2 py-2 sm:px-3 sm:py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 pl-6">
                                    </div>
                                    <div class="relative">
                                        <span class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-500 text-xs">$</span>
                                        <input type="number" name="precio_max" placeholder="Máx" 
                                               class="filter-input w-full bg-gray-50 border border-gray-300 rounded-lg sm:rounded-xl px-2 py-2 sm:px-3 sm:py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 pl-6">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Talla</label>
                                <select name="talla" class="filter-input w-full bg-gray-50 border border-gray-300 rounded-lg sm:rounded-xl px-3 py-2 sm:px-4 sm:py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Todas las tallas</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="Única">Única</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Estado</label>
                                <select name="estado" class="filter-input w-full bg-gray-50 border border-gray-300 rounded-lg sm:rounded-xl px-3 py-2 sm:px-4 sm:py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Todos los estados</option>
                                    <option value="Nuevo">Nuevo</option>
                                    <option value="Como nuevo">Como nuevo</option>
                                    <option value="Buen estado">Buen estado</option>
                                    <option value="Usado">Usado</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Ordenar por</label>
                                <select name="orden" class="filter-input w-full bg-gray-50 border border-gray-300 rounded-lg sm:rounded-xl px-3 py-2 sm:px-4 sm:py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                                    <option value="fecha_desc">Más recientes</option>
                                    <option value="precio_asc">Precio: menor a mayor</option>
                                    <option value="precio_desc">Precio: mayor a menor</option>
                                    <option value="descuento_desc">Mayor descuento</option>
                                </select>
                            </div>
                            <button id="clear-filters-button" class="w-full bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 py-2 sm:py-3 px-4 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm hover:from-gray-300 hover:to-gray-400 transition-all duration-300 transform hover:-translate-y-0.5 shadow-sm flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                </svg>
                                Limpiar Filtros
                            </button>
                        </div>
                    </div>
                </aside>

                {{-- Grid de Productos RESPONSIVE --}}
                <div class="flex-1 min-w-0">
                    <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                        <div class="p-4 sm:p-6 lg:p-8">
                            {{-- Contenedor para la rejilla --}}
                            <div id="product-grid-container">
                                @include('productos.partials.grid', ['productos' => $productos])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript para toggle de filtros en móviles --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filtersToggle = document.getElementById('filters-toggle');
            const filtersContainer = document.getElementById('filters-container');
            
            if (filtersToggle && filtersContainer) {
                filtersToggle.addEventListener('click', function() {
                    if (filtersContainer.classList.contains('hidden')) {
                        filtersContainer.classList.remove('hidden');
                        filtersContainer.classList.add('block');
                        filtersToggle.innerHTML = `
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Ocultar Filtros
                        `;
                    } else {
                        filtersContainer.classList.remove('block');
                        filtersContainer.classList.add('hidden');
                        filtersToggle.innerHTML = `
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                            </svg>
                            Mostrar Filtros
                        `;
                    }
                });
            }
        });
    </script>
</x-app-layout>
<!-- Cambio de estilos por Joha -->
